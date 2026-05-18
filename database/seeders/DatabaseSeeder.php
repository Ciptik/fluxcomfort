<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Создаем тестового админа
        User::create([
            'name' => 'Администратор Fluxcomfort',
            'email' => 'admin@fluxcomfort.ru',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '+79991112233',
            'address' => 'г. Краснодар, ул. Северная, 10'
        ]);

        // Создаем тестового покупателя
        User::create([
            'name' => 'Иван Иванов',
            'email' => 'user@mail.ru',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'phone' => '+79994445566',
            'address' => 'г. Белореченск, ул. Ленина, 5'
        ]);

        // Категории мебели
        $categories = [
            ['name' => 'Диваны', 'slug' => 'divany'],
            ['name' => 'Столы и стулья', 'slug' => 'stoly-i-stulya'],
            ['name' => 'Шкафы', 'slug' => 'shkafy'],
        ];

        foreach ($categories as $cat) {
            $catId = DB::table('categories')->insertGetId([
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Наполняем товарами каждую категорию
            for ($i = 1; $i <= 4; $i++) {
                DB::table('products')->insert([
                    'category_id' => $catId,
                    'name' => $cat['name'] . ' модель #' . $i,
                    'description' => 'Качественная и стильная мебель от фабрики Fluxcomfort. Отлично впишется в любой современный интерьер.',
                    'price' => rand(12000, 65000),
                    'image_path' => 'no_photo.jpg',
                    'stock' => rand(0, 5),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
