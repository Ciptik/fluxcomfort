<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    // Главная страница
    public function index()
    {
        $products = DB::table('products')->limit(4)->get();
        return view('welcome', compact('products'));
    }

    // Каталог товаров с полной фильтрацией и сортировкой
    public function catalog(Request $request)
    {
        $categories = DB::table('categories')->get();
        $query = DB::table('products');

        // 1. Фильтрация по категории мебели
        if ($request->filled('category')) {
            $category = DB::table('categories')->where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // 2. Фильтрация диапазона цен
        if ($request->filled('price_from')) {
            $query->where('price', '>=', (int)$request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', (int)$request->price_to);
        }

        // 3. Фильтрация по наличию на складе
        if ($request->filled('in_stock') && $request->in_stock == '1') {
            $query->where('stock', '>', 0);
        }

        // 4. Сортировка товаров
        $sort = $request->get('sort', 'popular');
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        // Пагинация по 6 товаров на страницу
        $products = $query->paginate(6);

        return view('catalog', compact('products', 'categories'));
    }

    // КАРТОЧКА ТОВАРА
    public function show($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) {
            abort(404, 'Модель мебели не найдена в базе фабрики');
        }
        return view('show', compact('product'));
    }

    // Просмотр корзины
    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('cart', compact('cart', 'total'));
    }

    // Добавление товара в корзину
    public function addToCart($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if(!$product) {
            return redirect()->back()->with('error', 'Товар не найден');
        }

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image_path
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Товар добавлен в корзину!');
    }

    // Умное удаление
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
                $message = 'Количество товара уменьшено';
            } else {
                unset($cart[$id]);
                $message = 'Товар удален из корзины';
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', $message);
        }

        return redirect()->back();
    }

    // СТРАНИЦА ОФОРМЛЕНИЯ ЗАКАЗА
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Ваша корзина пуста, нечего оформлять!');
        }
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return view('checkout', compact('cart', 'total'));
    }

    // Обработка оформления заказа
    public function storeOrder(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Ваша корзина пуста');
        }

        $request->validate([
            'delivery_method' => 'required|string',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Сохраняем заказ с корректным полем delivery_type под структуру БД
        $orderId = DB::table('orders')->insertGetId([
            'user_id' => Auth::id(),  
            'delivery_type' => $request->delivery_method,
            'phone' => $request->phone,
            'address' => $request->delivery_method === 'delivery' ? $request->address : 'Самовывоз с фабрики',
            'total_price' => $total,
            'status' => 'new',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Переносим товары в order_items
        foreach ($cart as $productId => $item) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Уменьшаем остаток на складе
            DB::table('products')->where('id', $productId)->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');

        return redirect()->route('dashboard')->with('success', 'Заказ успешно оформлен! Номер вашего мебельного заказа: #' . $orderId);
    }
}
