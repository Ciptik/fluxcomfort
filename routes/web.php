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

    // ЦЕПОЧКА ШАГ 3: Клиент платит по реквизитам и жмет кнопку "Подтвердить оплату"
    Route::post('/orders/{id}/pay', function ($id) {
        $order = DB::table('orders')->where('id', $id)->where('user_id', Auth::id())->first();
        if (!$order) abort(404);

        if ($order->status === 'awaiting_payment') {
            DB::table('orders')->where('id', $id)->update([
                'status' => 'payment_review',
                'updated_at' => now()
            ]);
            return redirect()->back()->with('success', 'Уведомление об оплате отправлено менеджеру. Ожидайте проверки выписки!');
        }
        return redirect()->back()->with('error', 'Этот заказ нельзя оплатить на данном этапе.');
    })->name('orders.pay');

    // Просмотр страницы конкретного заказа клиентом
    Route::get('/orders/{id}', function ($id) {
        $order = DB::table('orders')->where('id', $id)->where('user_id', Auth::id())->first();
        if (!$order) abort(404);

        $items = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_items.order_id', $id)
            ->select('order_items.*', 'products.name', 'products.image_path', 'products.slug')
            ->get();

        return view('orders.show', compact('order', 'items'));
    })->name('orders.show');
});

// --- ЛИЧНЫЙ КАБИНЕТ ПОЛЬЗОВАТЕЛЯ ---
Route::get('/dashboard', function () {
    $orders = DB::table('orders')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
    return view('dashboard', compact('orders'));
})->middleware(['auth', 'verified'])->name('dashboard');

// --- ПАНЕЛЬ АДМИНИСТРАТОРА (МЕНЕДЖЕР ФАБРИКИ FLUXCOMFORT) ---
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {

    // 1. Управление заказами (Главная админки)
    Route::get('/', function () {
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select('orders.*', 'users.name as user_name', 'users.phone as user_phone')
            ->orderBy('orders.created_at', 'desc')
            ->get();
        return view('admin.dashboard', compact('orders'));
    })->name('admin.dashboard');

    // Изменение статуса заказа админом
    Route::post('/orders/{id}/status', function (Request $request, $id) {
        $request->validate([
            'status' => 'required|in:new,awaiting_payment,payment_review,manufacturing,processing,delivery,completed,cancelled'
        ]);

        DB::table('orders')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);
        return redirect()->back()->with('success', 'Статус мебельного заказа успешно изменен!');
    })->name('admin.orders.status');

    // 3. Управление товарами (Список ассортимента)
    Route::get('/products', function () {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('products.id', 'desc')
            ->get();
        return view('admin.products', compact('products'));
    })->name('admin.products');

    // 4. Добавление товара (Форма создания)
    Route::get('/products/create', function () {
        $categories = DB::table('categories')->get();
        return view('admin.create_product', compact('categories'));
    })->name('admin.products.create');

    // 5. Добавление товара (Сохранение в БД)
    Route::post('/products/store', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $slug = \Illuminate\Support\Str::slug($request->name);
        $imagePath = 'images/products/default.jpg';

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $slug . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $imagePath = 'images/products/' . $filename;
        }

        DB::table('products')->insert([
            'name' => $request->name,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image_path' => $imagePath,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        return redirect()->route('admin.products')->with('success', 'Новая модель мебели успешно добавлена в каталог!');
    })->name('admin.products.store');

    // 6. Форма редактирования товара
    Route::get('/products/{id}/edit', function ($id) {
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        if (!$product) abort(404);
        return view('admin.edit_product', compact('product', 'categories'));
    })->name('admin.products.edit');

    // 7. Сохранение изменений товара
    Route::post('/products/{id}/update', function (Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) abort(404);

        $slug = \Illuminate\Support\Str::slug($request->name);
        $imagePath = $product->image_path;

        if ($request->hasFile('image')) {
            if ($product->image_path && $product->image_path !== 'images/products/default.jpg') {
                $oldFile = public_path($product->image_path);
                if (file_exists($oldFile)) {
                    @unlink($oldFile);
                }
            }

            $file = $request->file('image');
            $filename = $slug . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $imagePath = 'images/products/' . $filename;
        }

        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'slug' => $slug,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image_path' => $imagePath,
            'updated_at' => now()
        ]);
        return redirect()->route('admin.products')->with('success', 'Параметры мебели успешно обновлены!');
    })->name('admin.products.update');

    // 8. Управление пользователями
    Route::get('/users', function () {
        $users = DB::table('users')->orderBy('id', 'asc')->get();
        return view('admin.users', compact('users'));
    })->name('admin.users');

    // 9. Добавление пользователя
    Route::get('/users/create', function () {
        return view('admin.create_user');
    })->name('admin.users.create');

    // 10. Сохранение пользователя
    Route::post('/users/store', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,user',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.users')->with('success', 'Новый пользователь успешно добавлен!');
    })->name('admin.users.store');

    // 11. Изменение роли пользователя
    Route::post('/users/{id}/role', function (Request $request, $id) {
        if (Auth::id() == $id) {
            return redirect()->back()->with('error', 'Вы не можете изменить роль самому себе!');
        }

        DB::table('users')->where('id', $id)->update([
            'role' => $request->role,
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Права доступа пользователя успешно изменены.');
    })->name('admin.users.role');

    // 12. Форма редактирования пользователя
    Route::get('/users/{id}/edit', function ($id) {
        $user = DB::table('users')->where('id', $id)->first();
        if (!$user) abort(404);
        return view('admin.edit_user', compact('user'));
    })->name('admin.users.edit');

    // 13. Сохранение изменений пользователя
    Route::put('/users/{id}/update', function (Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,user',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => now()
        ];

        if (Auth::id() != $id) {
            $updateData['role'] = $request->role;
        }

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('users')->where('id', $id)->update($updateData);
        return redirect()->route('admin.users')->with('success', 'Данные пользователя успешно обновлены в базе!');
    })->name('admin.users.update');
});

// --- ПРОФИЛЬ ПОЛЬЗОВАТЕЛЯ (BREEZE СТАНДАРТ) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- ИНФОРМАЦИОННЫЕ СТРАНИЦЫ ---
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/delivery', 'delivery')->name('delivery');
Route::view('/about', 'about')->name('about');
Route::view('/contacts', 'contacts')->name('contacts');
Route::post('/contacts/send', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);
    return redirect()->back()->with('success', 'Ваш запрос успешно отправлен главному технологу фабрики!');
})->name('contacts.messages.store');

require __DIR__.'/auth.php';
