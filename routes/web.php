<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

// --- ВИТРИНА, КАТАЛОГ И КАРТОЧКА ТОВАРА ---
Route::get('/', [ShopController::class, 'index']);
Route::get('/catalog', [ShopController::class, 'catalog'])->name('catalog');
Route::get('/catalog/{id}', [ShopController::class, 'show'])->name('catalog.show');

// --- КОРЗИНА СИСТЕМЫ ---
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::post('/add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('cart.add');
Route::patch('/cart/update/{id}', [ShopController::class, 'updateCart'])->name('cart.update');
Route::delete('/remove-from-cart/{id}', [ShopController::class, 'removeFromCart'])->name('cart.remove');

// --- ОФОРМЛЕНИЕ ЗАКАЗА И КЛИЕНТСКИЕ ДЕЙСТВИЯ (ОБЯЗАТЕЛЬНО ПОД АВТОРИЗАЦИЕЙ) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [ShopController::class, 'storeOrder'])->name('orders.store');

    // ЦЕПОЧКА ИСТОРИИ ЗАКАЗОВ КЛИЕНТА
    Route::get('/dashboard', function () {
        $orders = DB::table('orders')
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        foreach ($orders as $order) {
            $order->items = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->where('order_items.order_id', $order->id)
                ->select('order_items.*', 'products.name as product_name', 'products.image_path')
                ->get();
        }

        return view('dashboard', compact('orders'));
    })->name('dashboard');

    Route::get('/orders/{id}', function ($id) {
        $order = DB::table('orders')->where('id', $id)->where('user_id', Auth::id())->first();
        if (!$order) abort(404);

        $items = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_items.order_id', $order->id)
            ->select('order_items.*', 'products.name as product_name', 'products.image_path')
            ->get();

        return view('orders.show', compact('order', 'items'));
    })->name('orders.show');
});

// --- СТАНДАРТНЫЙ ПРОФИЛЬ (BREEZE) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- ИНФОРМАЦИОННЫЕ СТРАНИЦЫ ФАБРИКИ ---
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/delivery', 'delivery')->name('delivery');
Route::view('/about', 'about')->name('about');
Route::view('/contacts', 'contacts')->name('contacts');

// --- УПРАВЛЕНИЕ АДМИНИСТРАТОРА (BACK-OFFICE FLUXCOMFORT) ---
Route::middleware([AdminMiddleware::class])->group(function () {
    
    // 1. ПАНЕЛЬ ЗАКАЗОВ (ГЛАВНАЯ АДМИНКИ)
    Route::get('/admin', function () {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name', 'users.email as user_email')
            ->orderBy('id', 'desc')
            ->get();

        foreach ($orders as $order) {
            $order->items = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->where('order_items.order_id', $order->id)
                ->select('order_items.*', 'products.name as product_name')
                ->get();
        }

        return view('admin.dashboard', compact('orders'));
    })->name('admin.dashboard');

    // ОБНОВЛЕНИЕ СТАТУСА ЗАКАЗА АДМИНИСТРАТОРОМ
    Route::patch('/admin/orders/{id}/status', function (Request $request, $id) {
        $request->validate(['status' => 'required|string']);
        DB::table('orders')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);
        return redirect()->back()->with('success', "Статус заказа #{$id} успешно изменен.");
    })->name('admin.orders.status.update');

    // БЕЗОПАСНОЕ УДАЛЕНИЕ ЗАКАЗА С ВОЗВРАТОМ НА СКЛАД
    Route::delete('/admin/orders/{id}', function ($id) {
        $order = DB::table('orders')->where('id', $id)->first();
        if (!$order) return redirect()->back()->with('error', 'Заказ не найден.');

        if ($order->status !== 'cancelled') {
            $items = DB::table('order_items')->where('order_id', $id)->get();
            foreach ($items as $item) {
                DB::table('products')->where('id', $item->product_id)->increment('stock', $item->quantity);
            }
        }

        DB::table('order_items')->where('order_id', $id)->delete();
        DB::table('orders')->where('id', $id)->delete();

        return redirect()->back()->with('success', "Заказ #{$id} успешно удален.");
    })->name('admin.orders.delete');

    // 2. УПРАВЛЕНИЕ ТОВАРАМИ
    Route::get('/admin/products', function () {
        $products = DB::table('products')->orderBy('id', 'desc')->get();
        return view('admin.products', compact('products'));
    })->name('admin.products');

    Route::get('/admin/products/create', function () {
        $categories = DB::table('categories')->get();
        return view('admin.create_product', compact('categories'));
    })->name('admin.products.create');

    Route::post('/admin/products', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $imagePath = 'images/products/' . $filename;
        }

        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image_path' => $imagePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.products')->with('success', 'Новая модель успешно добавлена в каталог фабрики.');
    })->name('admin.products.store');

    Route::get('/admin/products/{id}/edit', function ($id) {
        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) abort(404);
        $categories = DB::table('categories')->get();
        return view('admin.edit_product', compact('product', 'categories'));
    })->name('admin.products.edit');

    Route::put('/admin/products/{id}', function (Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|integer',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $updateData = [
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'updated_at' => now(),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/products'), $filename);
            $updateData['image_path'] = 'images/products/' . $filename;
        }

        DB::table('products')->where('id', $id)->update($updateData);
        return redirect()->route('admin.products')->with('success', 'Параметры модели мебели успешно обновлены.');
    })->name('admin.products.update');

    // УДАЛЕНИЕ ТОВАРА
    Route::delete('/admin/products/{id}', function ($id) {
        $hasOrders = DB::table('order_items')->where('product_id', $id)->exists();
        if ($hasOrders) {
            DB::table('products')->where('id', $id)->update(['stock' => 0]);
            return redirect()->back()->with('error', 'Товар содержится в заказах. Остаток обнулен.');
        }
        DB::table('products')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Товар удален.');
    })->name('admin.products.delete');

    // 3. УПРАВЛЕНИЕ ПОЛЬЗОВАТЕЛЯМИ
    Route::get('/admin/users', function () {
        $users = DB::table('users')->orderBy('id', 'desc')->get();
        return view('admin.users', compact('users'));
    })->name('admin.users');

    Route::get('/admin/users/create', function () {
        return view('admin.create_user');
    })->name('admin.users.create');

    Route::post('/admin/users', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:user,admin',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.users')->with('success', 'Пользователь успешно зарегистрирован.');
    })->name('admin.users.store');

    Route::get('/admin/users/{id}/edit', function ($id) {
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) abort(404);
        return view('admin.edit_user', compact('user'));
    })->name('admin.users.edit');

    Route::put('/admin/users/{id}', function (Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role' => 'required|string|in:user,admin',
            'password' => 'nullable|string|min:8',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($updateData);
        return redirect()->route('admin.users')->with('success', 'Данные учетной записи успешно изменены.');
    })->name('admin.users.update');

    // УДАЛЕНИЕ ПОЛЬЗОВАТЕЛЯ
    Route::delete('/admin/users/{id}', function ($id) {
        if ((int)$id === (int)Auth::id()) {
            return redirect()->back()->with('error', 'Нельзя удалить себя.');
        }
        $userOrders = DB::table('orders')->where('user_id', $id)->pluck('id');
        if ($userOrders->isNotEmpty()) {
            DB::table('order_items')->whereIn('order_id', $userOrders)->delete();
            DB::table('orders')->where('user_id', $id)->delete();
        }
        DB::table('users')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Пользователь удален.');
    })->name('admin.users.delete');
});

require __DIR__.'/auth.php';
