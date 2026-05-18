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
        // 1. Безопасная очистка старых данных перед заполнением
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::table('products')->truncate();
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 2. Создаем тестового админа
        User::create([
            'name' => 'Администратор Fluxcomfort',
            'email' => 'admin@fluxcomfort.ru',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '+79991112233',
            'address' => 'г. Краснодар, ул. Северная, 10'
        ]);

        // 3. Создаем тестового покупателя
        User::create([
            'name' => 'Иван Иванов',
            'email' => 'user@mail.ru',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'phone' => '+79994445566',
            'address' => 'г. Белореченск, ул. Ленина, 5'
        ]);

        // 4. Твои пять премиальных категорий
        $categories = [
            ['name' => 'Диваны', 'slug' => 'divany'],
            ['name' => 'Столы и стулья', 'slug' => 'stoly-i-stulya'],
            ['name' => 'Шкафы', 'slug' => 'shkafy'],
            ['name' => 'Кровати', 'slug' => 'krovati'],
            ['name' => 'Кухни', 'slug' => 'kuhni'],
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Получаем ID всех 5 категорий
        $sofasId = DB::table('categories')->where('slug', 'divany')->value('id');
        $tablesId = DB::table('categories')->where('slug', 'stoly-i-stulya')->value('id');
        $cabinetsId = DB::table('categories')->where('slug', 'shkafy')->value('id');
        $bedsId = DB::table('categories')->where('slug', 'krovati')->value('id');
        $kitchensId = DB::table('categories')->where('slug', 'kuhni')->value('id');

        // 5. Наполнение уникальными премиальными товарами (по 4 на категорию, итого 20 товаров)
        DB::table('products')->insert([
            // --- КАТЕГОРИЯ: ДИВАНЫ ---
            [
                'category_id' => $sofasId,
                'name' => 'Модульный диван FLUX-01',
                'slug' => 'flux-01-sofa',
                'price' => 89000.00,
                'stock' => 5,
                'description' => 'Низкий профиль, премиальный графитовый шенилл. Модульная конструкция для премиальных гостиных.',
                'image_path' => 'images/products/sofa_01.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $sofasId,
                'name' => 'Угловой диван BLOCK-M',
                'slug' => 'block-m-sofa',
                'price' => 124000.00,
                'stock' => 2,
                'description' => 'Строгая геометрия, обивка из глубокого текстурного букле цвета антрацит. Элегантная архитектурная форма.',
                'image_path' => 'images/products/sofa_02.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $sofasId,
                'name' => 'Кушетка монолитная RAW-S',
                'slug' => 'raw-s-sofa',
                'price' => 45000.00,
                'stock' => 3,
                'description' => 'Минималистичная прямоугольная кушетка из плотного льняного полотна теплого серого оттенка.',
                'image_path' => 'images/products/sofa_03.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $sofasId,
                'name' => 'Трехместный диван ТЕКСТУРА-Ц',
                'slug' => 'tekstura-c-sofa',
                'price' => 165000.00,
                'stock' => 1,
                'description' => 'Премиальная натуральная кожа Onyx, массивные подушки, брутальное стальное основание.',
                'image_path' => 'images/products/sofa_04.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],

            // --- КАТЕГОРИЯ: СТОЛЫ И СТУЛЬЯ ---
            [
                'category_id' => $tablesId,
                'name' => 'Обеденный стол ТЕКТОНИКА',
                'slug' => 'tektonika-table',
                'price' => 56000.00,
                'stock' => 4,
                'description' => 'Массивная столешница из мореного дуба, кованые матовые опоры. Эксклюзивный дизайн.',
                'image_path' => 'images/products/table_01.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $tablesId,
                'name' => 'Стул промышленный КАРКАС-Т',
                'slug' => 'karkas-t-chair',
                'price' => 12000.00,
                'stock' => 24,
                'description' => 'Дизайнерский стул на тонком стальном каркасе полуматового черного цвета. Сиденье из тонированного дуба.',
                'image_path' => 'images/products/chair_01.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $tablesId,
                'name' => 'Стол рабочий MATRIX-W',
                'slug' => 'matrix-w-table',
                'price' => 38000.00,
                'stock' => 9,
                'description' => 'Кабинетный рабочий стол с матовым премиальным покрытием и скрытыми кабель-каналами.',
                'image_path' => 'images/products/table_02.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $tablesId,
                'name' => 'Барный стул ВЕРТИКАЛЬ-Х',
                'slug' => 'vertikal-x-chair',
                'price' => 15000.00,
                'stock' => 12,
                'description' => 'Высокий стул на титановом стержневом каркасе с анатомическим сиденьем из темного ореха.',
                'image_path' => 'images/products/chair_02.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],

            // --- КАТЕГОРИЯ: ШКАФЫ ---
            [
                'category_id' => $cabinetsId,
                'name' => 'Шкаф платяной MONOLITH-3',
                'slug' => 'monolith-3-cabinet',
                'price' => 78000.00,
                'stock' => 3,
                'description' => 'Встроенная бесшовная система хранения, матовые антрацитовые фасады, система Push-to-open.',
                'image_path' => 'images/products/cabinet_01.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $cabinetsId,
                'name' => 'Стеллаж индустриальный GRID-8',
                'slug' => 'grid-8-cabinet',
                'price' => 42000.00,
                'stock' => 8,
                'description' => 'Открытый стеллаж из анодированного алюминия, полки из тонированного стекла и темного дуба.',
                'image_path' => 'images/products/cabinet_02.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $cabinetsId,
                'name' => 'Комод монолитный СЕЙФ-4',
                'slug' => 'seif-4-cabinet',
                'price' => 31000.00,
                'stock' => 11,
                'description' => 'Низкий комод с рифлеными металлическими фасадами и латунными деталями. Премиальный лофт.',
                'image_path' => 'images/products/cabinet_03.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $cabinetsId,
                'name' => 'Книжный шкаф БЕТОН-Ф',
                'slug' => 'beton-f-cabinet',
                'price' => 92000.00,
                'stock' => 2,
                'description' => 'Монументальный шкаф из темного дуба со вставками из шлифованного архитектурного камня.',
                'image_path' => 'images/products/cabinet_04.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],

            // --- КАТЕГОРИЯ: КРОВАТИ ---
            [
                'category_id' => $bedsId,
                'name' => 'Кровать двуспальная CONCRETE-B',
                'slug' => 'concrete-b-bed',
                'price' => 95000.00,
                'stock' => 3,
                'description' => 'Эффект парения в воздухе, контурная LED-подсветка, широкое изголовье из благородного нубука.',
                'image_path' => 'images/products/bed_01.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $bedsId,
                'name' => 'Лофт-кровать STEEL-BASE',
                'slug' => 'steel-base-bed',
                'price' => 67000.00,
                'stock' => 6,
                'description' => 'Основание из матового черного конструкционного профиля, ортопедическая элитная основа.',
                'image_path' => 'images/products/bed_02.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $bedsId,
                'name' => 'Минималистичный подиум RAW-BED',
                'slug' => 'raw-bed-bed',
                'price' => 54000.00,
                'stock' => 2,
                'description' => 'Ультранизкое спальное место из редкого цельного массива ясеня. Премиальная лаконичность.',
                'image_path' => 'images/products/bed_03.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $bedsId,
                'name' => 'Кровать монолитная BLOCK-BED',
                'slug' => 'block-bed-bed',
                'price' => 110000.00,
                'stock' => 4,
                'description' => 'Массивный мягкий каркас в обивке из серого кашемира, крупное изголовье геометрической формы.',
                'image_path' => 'images/products/bed_04.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],

            // --- КАТЕГОРИЯ: КУХНИ ---
            [
                'category_id' => $kitchensId,
                'name' => 'Кухонный гарнитур CEMENT-X',
                'slug' => 'cement-x-kitchen',
                'price' => 240000.00,
                'stock' => 1,
                'description' => 'Элитный гарнитур с текстурой темного сланца, интегрированная техника top-tier, скрытая фурнитура.',
                'image_path' => 'images/products/kitchen_01.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $kitchensId,
                'name' => 'Модульная кухня МЕТАЛЛ-9',
                'slug' => 'metall-9-kitchen',
                'price' => 185000.00,
                'stock' => 4,
                'description' => 'Фасады из шлифованного титанового сплава, вечная столешница из черного матового мрамора.',
                'image_path' => 'images/products/kitchen_02.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $kitchensId,
                'name' => 'Кухонный остров ТЯЖЕСТЬ',
                'slug' => 'tyazhest-kitchen',
                'price' => 135000.00,
                'stock' => 3,
                'description' => 'Монолитный отдельно стоящий остров из цельного куска мрамора Nero Marquina. Интегрированная раковина.',
                'image_path' => 'images/products/kitchen_03.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
            [
                'category_id' => $kitchensId,
                'name' => 'Компакт-кухня МИНИМАЛ-К',
                'slug' => 'minimal-k-kitchen',
                'price' => 115000.00,
                'stock' => 5,
                'description' => 'Сжатый кухонный блок для студий бизнес-класса. Матовое дерево, столешница из темного кварца.',
                'image_path' => 'images/products/kitchen_04.jpg',
                'created_at' => now(), 'updated_at' => now()
            ],
        ]);
    }
}
