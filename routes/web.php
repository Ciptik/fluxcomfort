<?php

use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// --- ВИТРИНА, КАТАЛОГ И КАРТОЧКА ТОВАРА ---
Route::get('/', [ShopController::class, 'index']);
Route::get('/catalog', [ShopController::class, 'catalog'])->name('catalog');
Route::get('/catalog/{id}', [ShopController::class, 'show'])->name('catalog.show');

// --- КОРЗИНА СИСТЕМЫ ---
Route::get('/cart', [ShopController::class, 'cart'])->name('cart');
Route::post('/add-to-cart/{id}', [ShopController::class, 'addToCart'])->name('cart.add');
Route::delete('/remove-from-cart/{id}', [ShopController::class, 'removeFromCart'])->name('cart.remove');

// --- ОФОРМЛЕНИЕ ЗАКАЗА (ОБЯЗАТЕЛЬНО ПОД АВТОРИЗАЦИЕЙ) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [ShopController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [ShopController::class, 'storeOrder'])->name('orders.store');
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

    Route::post('/orders/{id}/status', function (Request $request, $id) {
        DB::table('orders')->where('id', $id)->update([
            'status' => $request->status,
            'updated_at' => now()
        ]);
        return redirect()->back()->with('success', 'Статус мебельного заказа успешно изменен!');
    })->name('admin.orders.status');

    // 2. Управление товарами (Список ассортимента)
    Route::get('/products', function () {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->orderBy('products.id', 'desc')
            ->get();
        return view('admin.products', compact('products'));
    })->name('admin.products');

    // 3. Добавление товара (Форма создания)
    Route::get('/products/create', function () {
        $categories = DB::table('categories')->get();
        return view('admin.create_product', compact('categories'));
    })->name('admin.products.create');

    // 4. Добавление товара (Сохранение в БД)
    Route::post('/products/store', function (Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        $slug = \Illuminate\Support\Str::slug($request->name);

        DB::table('products')->insert([
            'name' => $request->name,
            'slug' => $slug,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'image_path' => 'images/products/default.jpg',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->route('admin.products')->with('success', 'Новая модель мебели успешно добавлена в каталог!');
    })->name('admin.products.store');

    // 5. Форма редактирования товара
    Route::get('/products/{id}/edit', function ($id) {
        $product = DB::table('products')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        if (!$product) abort(404);
        return view('admin.edit_product', compact('product', 'categories'));
    })->name('admin.products.edit');

    // 6. Сохранение изменений товара
    Route::post('/products/{id}/update', function (Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
        ]);

        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.products')->with('success', 'Параметры мебели успешно обновлены!');
    })->name('admin.products.update');

    // 7. Управление пользователями (Список аккаунтов)
    Route::get('/users', function () {
        $users = DB::table('users')->orderBy('id', 'asc')->get();
        return view('admin.users', compact('users'));
    })->name('admin.users');

    // 8. Изменение роли пользователя (Админ/Пользователь)
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
});

// --- ПРОФИЛЬ ПОЛЬЗОВАТЕЛЯ (BREEZE СТАНДАРТ) ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// --- ИНФОРМАЦИОННЫЕ СТРАНИЦЫ ДЛЯ ДИПЛОМА (ФЗ-152 И УСЛОВИЯ ДОСТАВКИ) ---
Route::view('/privacy', 'privacy')->name('privacy');
Route::view('/delivery', 'delivery')->name('delivery');
Route::view('/about', 'about')->name('about');
Route::view('/contacts', 'contacts')->name('contacts');

// Имитация бэкенда для формы обратной связи (чтобы фронтенд-код LLM не падал)
Route::post('/contacts/send', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);
    return redirect()->back()->with('success', 'Ваш запрос успешно отправлен главному технологу фабрики!');
})->name('contacts.messages.store');

require __DIR__.'/auth.php';
