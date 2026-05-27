<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Ulyabi',
            'email' => 'ulyabi@gmail.com',
            'password' => Hash::make('Ulyabi123'),
            'is_admin' => true,
        ]);

        $categories = [
            ['name' => 'Snack', 'slug' => 'snack'],
            ['name' => 'Cake', 'slug' => 'cake'],
            ['name' => 'Strudel', 'slug' => 'strudel'],
            ['name' => 'Catering', 'slug' => 'catering'],
        ];

        $subcategories = [
            ['category' => 'Snack', 'name' => 'Gorengan', 'slug' => 'gorengan'],
            ['category' => 'Snack', 'name' => 'Keripik', 'slug' => 'keripik'],
            ['category' => 'Snack', 'name' => 'Dessert Box', 'slug' => 'dessert-box'],
            ['category' => 'Cake', 'name' => 'Bolu Coklat', 'slug' => 'bolu-coklat'],
            ['category' => 'Cake', 'name' => 'Brownies', 'slug' => 'brownies'],
            ['category' => 'Cake', 'name' => 'Cheesecake', 'slug' => 'cheesecake'],
            ['category' => 'Strudel', 'name' => 'Strudel Pisang Coklat', 'slug' => 'strudel-pisang-coklat'],
            ['category' => 'Strudel', 'name' => 'Strudel Ayam', 'slug' => 'strudel-ayam'],
            ['category' => 'Strudel', 'name' => 'Strudel Keju', 'slug' => 'strudel-keju'],
            ['category' => 'Catering', 'name' => 'Paket Catering 1', 'slug' => 'paket-catering-1'],
            ['category' => 'Catering', 'name' => 'Paket Catering 2', 'slug' => 'paket-catering-2'],
            ['category' => 'Catering', 'name' => 'Nasi Box', 'slug' => 'nasi-box'],
        ];

        $products = [
            ['subcategory' => 'Gorengan', 'name' => 'Pisang Goreng Crispy', 'price' => 15000, 'best' => true, 'new' => false],
            ['subcategory' => 'Gorengan', 'name' => 'Tahu Isi Pedas', 'price' => 12000, 'best' => false, 'new' => true],
            ['subcategory' => 'Gorengan', 'name' => 'Tempe Mendoan', 'price' => 10000, 'best' => false, 'new' => false],
            ['subcategory' => 'Gorengan', 'name' => 'Bakwan Jagung', 'price' => 10000, 'best' => true, 'new' => false],
            ['subcategory' => 'Keripik', 'name' => 'Keripik Singkong Balado', 'price' => 18000, 'best' => false, 'new' => false],
            ['subcategory' => 'Keripik', 'name' => 'Keripik Kentang BBQ', 'price' => 20000, 'best' => false, 'new' => true],
            ['subcategory' => 'Keripik', 'name' => 'Keripik Pisang Manis', 'price' => 15000, 'best' => true, 'new' => false],
            ['subcategory' => 'Dessert Box', 'name' => 'Dessert Box Coklat', 'price' => 30000, 'best' => true, 'new' => false],
            ['subcategory' => 'Dessert Box', 'name' => 'Dessert Box Red Velvet', 'price' => 32000, 'best' => false, 'new' => true],
            ['subcategory' => 'Dessert Box', 'name' => 'Dessert Box Tiramisu', 'price' => 35000, 'best' => false, 'new' => false],
            ['subcategory' => 'Bolu Coklat', 'name' => 'Bolu Coklat Kukus', 'price' => 45000, 'best' => false, 'new' => false],
            ['subcategory' => 'Bolu Coklat', 'name' => 'Bolu Coklat Panggang', 'price' => 55000, 'best' => true, 'new' => false],
            ['subcategory' => 'Bolu Coklat', 'name' => 'Bolu Coklat Keju', 'price' => 60000, 'best' => false, 'new' => true],
            ['subcategory' => 'Brownies', 'name' => 'Brownies Coklat', 'price' => 50000, 'best' => true, 'new' => false],
            ['subcategory' => 'Brownies', 'name' => 'Brownies Keju', 'price' => 55000, 'best' => false, 'new' => false],
            ['subcategory' => 'Brownies', 'name' => 'Brownies Red Velvet', 'price' => 65000, 'best' => false, 'new' => true],
            ['subcategory' => 'Cheesecake', 'name' => 'Cheesecake Original', 'price' => 75000, 'best' => false, 'new' => false],
            ['subcategory' => 'Cheesecake', 'name' => 'Cheesecake Oreo', 'price' => 80000, 'best' => true, 'new' => false],
            ['subcategory' => 'Cheesecake', 'name' => 'Cheesecake Strawberry', 'price' => 85000, 'best' => false, 'new' => true],
            ['subcategory' => 'Strudel Pisang Coklat', 'name' => 'Strudel Pisang Coklat Original', 'price' => 25000, 'best' => true, 'new' => false],
            ['subcategory' => 'Strudel Pisang Coklat', 'name' => 'Strudel Pisang Coklat Keju', 'price' => 28000, 'best' => false, 'new' => true],
            ['subcategory' => 'Strudel Pisang Coklat', 'name' => 'Strudel Pisang Coklat Almond', 'price' => 30000, 'best' => false, 'new' => false],
            ['subcategory' => 'Strudel Ayam', 'name' => 'Strudel Ayam Mayonaise', 'price' => 25000, 'best' => false, 'new' => false],
            ['subcategory' => 'Strudel Ayam', 'name' => 'Strudel Ayam Keju', 'price' => 27000, 'best' => true, 'new' => false],
            ['subcategory' => 'Strudel Ayam', 'name' => 'Strudel Ayam Pedas', 'price' => 25000, 'best' => false, 'new' => true],
            ['subcategory' => 'Strudel Keju', 'name' => 'Strudel Keju Original', 'price' => 22000, 'best' => false, 'new' => false],
            ['subcategory' => 'Strudel Keju', 'name' => 'Strudel Keju Coklat', 'price' => 25000, 'best' => false, 'new' => false],
            ['subcategory' => 'Strudel Keju', 'name' => 'Strudel Keju Strawberry', 'price' => 25000, 'best' => true, 'new' => true],
            ['subcategory' => 'Paket Catering 1', 'name' => 'Paket Catering 1 - Ayam Goreng', 'price' => 35000, 'best' => true, 'new' => false],
            ['subcategory' => 'Paket Catering 1', 'name' => 'Paket Catering 1 - Ayam Bakar', 'price' => 38000, 'best' => false, 'new' => true],
            ['subcategory' => 'Paket Catering 2', 'name' => 'Paket Catering 2 - Ayam Goreng', 'price' => 40000, 'best' => false, 'new' => false],
            ['subcategory' => 'Paket Catering 2', 'name' => 'Paket Catering 2 - Ayam Bakar', 'price' => 45000, 'best' => true, 'new' => false],
            ['subcategory' => 'Nasi Box', 'name' => 'Nasi Box Ayam Goreng', 'price' => 30000, 'best' => false, 'new' => true],
            ['subcategory' => 'Nasi Box', 'name' => 'Nasi Box Ayam Bakar', 'price' => 35000, 'best' => false, 'new' => false],
            ['subcategory' => 'Nasi Box', 'name' => 'Nasi Box Ayam Kecap', 'price' => 32000, 'best' => true, 'new' => false],
        ];

        $images = [
            'https://images.unsplash.com/photo-1624378439575-d8705ad7ae80?w=600&q=80',
            'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?w=600&q=80',
            'https://images.unsplash.com/photo-1551024601-bec78aea704b?w=600&q=80',
            'https://images.unsplash.com/photo-1546069901-ba1589c3e8e9?w=600&q=80',
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&q=80',
            'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=600&q=80',
            'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600&q=80',
            'https://images.unsplash.com/photo-1565958011703-44f9829ba187?w=600&q=80',
            'https://images.unsplash.com/photo-1578985545062-28b1d6b0c9d1?w=600&q=80',
            'https://images.unsplash.com/photo-1551218804-3e2f9d7a0b8c?w=600&q=80',
            'https://images.unsplash.com/photo-1606788053949-17003b7c0b1c?w=600&q=80',
            'https://images.unsplash.com/photo-1509365465985-25d11c17e812?w=600&q=80',
            'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=600&q=80',
            'https://images.unsplash.com/photo-1604909052743-94e838986d24?w=600&q=80',
            'https://images.unsplash.com/photo-1555126634-323283e090fa?w=600&q=80',
            'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=600&q=80',
            'https://images.unsplash.com/photo-1488477181946-6428a0291777?w=600&q=80',
            'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=600&q=80',
            'https://images.unsplash.com/photo-1559715745-e1b33a271c8f?w=600&q=80',
            'https://images.unsplash.com/photo-1574484284002-952d92456975?w=600&q=80',
        ];

        $descriptions = [
            'Snack' => [
                'Gorengan' => 'Gorengan crispy yang renyah di luar dan lembut di dalam. Dibuat dari bahan-bahan segar pilihan.',
                'Keripik' => 'Keripik renyah dengan cita rasa yang menggoda. Cocok untuk cemilan sehari-hari.',
                'Dessert Box' => 'Dessert box dengan lapisan yang sempurna. Manis, creamy, dan bikin nagih!',
            ],
            'Cake' => [
                'Bolu Coklat' => 'Bolu coklat lembut dengan rasa coklat yang kaya. Setiap gigitan terasa seperti surga.',
                'Brownies' => 'Brownies fudgy dengan tekstur yang sempurna. Cocok untuk pecinta coklat sejati.',
                'Cheesecake' => 'Cheesecake creamy dengan topping yang segar. Dessert kelas restoran di rumah Anda.',
            ],
            'Strudel' => [
                'Strudel Pisang Coklat' => 'Strudel dengan isian pisang dan coklat yang meleleh. Pastry renyah dengan filling yang manis.',
                'Strudel Ayam' => 'Strudel gurih dengan isian ayam pilihan. Cocok untuk camilan atau lauk.',
                'Strudel Keju' => 'Strudel dengan keju yang melimpah. Gurih, renyah, dan bikin nagih!',
            ],
            'Catering' => [
                'Paket Catering 1' => 'Paket catering lengkap dengan ayam goreng, capcay, sambal, dan lalapan. Porsi untuk 1 orang.',
                'Paket Catering 2' => 'Paket catering dengan ayam bakar, tumis kangkung, tahu, dan sambal. Porsi untuk 1 orang.',
                'Nasi Box' => 'Nasi box praktis dengan lauk pilihan. Cocok untuk acara dan meeting.',
            ],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        foreach ($subcategories as $sub) {
            $category = Category::where('slug', $sub['category'])->first();
            Subcategory::create([
                'category_id' => $category->id,
                'name' => $sub['name'],
                'slug' => $sub['slug'],
            ]);
        }

        $imageIndex = 0;
        foreach ($products as $prod) {
            $subcategory = Subcategory::where('name', $prod['subcategory'])->first();
            if (!$subcategory) continue;

            $catName = $subcategory->category->name;
            $subName = $subcategory->name;

            Product::create([
                'subcategory_id' => $subcategory->id,
                'name' => $prod['name'],
                'slug' => Str::slug($prod['name']) . '-' . Str::random(5),
                'description' => $descriptions[$catName][$subName] ?? 'Produk berkualitas dari Ulyabi.',
                'image' => $images[$imageIndex % count($images)],
                'price' => $prod['price'],
                'stock' => rand(10, 80),
                'is_best_seller' => $prod['best'],
                'is_new_arrival' => $prod['new'],
            ]);

            $imageIndex++;
        }
    }
}
