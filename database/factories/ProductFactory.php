<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    private static array $productNames = [
        'Snack' => [
            'Gorengan' => [
                'Pisang Goreng Crispy', 'Tahu Isi', 'Tempe Mendoan', 'Bakwan Jagung', 'Risol Mayo',
            ],
            'Keripik' => [
                'Keripik Singkong Balado', 'Keripik Kentang BBQ', 'Keripik Pisang Manis', 'Keripik Ubi Ungu', 'Stik Keju',
            ],
            'Dessert Box' => [
                'Dessert Box Coklat', 'Dessert Box Red Velvet', 'Dessert Box Tiramisu', 'Dessert Box Matcha', 'Puding Coklat',
            ],
        ],
        'Cake' => [
            'Bolu Coklat' => [
                'Bolu Coklat Kukus', 'Bolu Coklat Panggang', 'Bolu Coklat Keju', 'Bolu Coklat Kacang', 'Bolu Coklat Vla',
            ],
            'Brownies' => [
                'Brownies Coklat', 'Brownies Keju', 'Brownies Almond', 'Brownies Red Velvet', 'Brownies Matcha',
            ],
            'Cheesecake' => [
                'Cheesecake Original', 'Cheesecake Oreo', 'Cheesecake Strawberry', 'Cheesecake Blueberry', 'Cheesecake Mangga',
            ],
        ],
        'Strudel' => [
            'Strudel Pisang Coklat' => [
                'Strudel Pisang Coklat Original', 'Strudel Pisang Coklat Keju', 'Strudel Pisang Coklat Almond', 'Strudel Pisang Coklat Crispy', 'Strudel Pisang Coklat Spesial',
            ],
            'Strudel Ayam' => [
                'Strudel Ayam Mayonaise', 'Strudel Ayam Keju', 'Strudel Ayam Pedas', 'Strudel Ayam BBQ', 'Strudel Ayam Spesial',
            ],
            'Strudel Keju' => [
                'Strudel Keju Original', 'Strudel Keju Coklat', 'Strudel Keju Strawberry', 'Strudel Keju Blueberry', 'Strudel Keju Mixed',
            ],
        ],
        'Catering' => [
            'Paket Catering 1' => [
                'Paket Catering 1 - Ayam Goreng', 'Paket Catering 1 - Ayam Bakar', 'Paket Catering 1 - Ayam Kecap', 'Paket Catering 1 - Ayam Pedas', 'Paket Catering 1 - Ayam Mentega',
            ],
            'Paket Catering 2' => [
                'Paket Catering 2 - Ayam Goreng', 'Paket Catering 2 - Ayam Bakar', 'Paket Catering 2 - Ayam Kecap', 'Paket Catering 2 - Ayam Pedas', 'Paket Catering 2 - Ayam Mentega',
            ],
            'Nasi Box' => [
                'Nasi Box Ayam Goreng', 'Nasi Box Ayam Bakar', 'Nasi Box Ayam Kecap', 'Nasi Box Ayam Pedas', 'Nasi Box Ayam Mentega',
            ],
        ],
    ];

    private static array $descriptions = [
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

    private static array $images = [
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
        'https://images.unsplash.com/photo-1578985545062-28b1d6b0c9d1?w=600&q=80',
    ];

    public function definition(): array
    {
        $subcategoryId = $this->faker->randomElement(Subcategory::pluck('id')->toArray());
        $subcategory = Subcategory::with('category')->find($subcategoryId);
        $categoryName = $subcategory->category->name;
        $subcategoryName = $subcategory->name;

        $names = self::$productNames[$categoryName][$subcategoryName] ?? ['Produk ' . $this->faker->word()];
        $name = $this->faker->randomElement($names);
        $description = self::$descriptions[$categoryName][$subcategoryName] ?? 'Produk berkualitas tinggi dari Ulyabi.';

        $basePrice = match ($categoryName) {
            'Snack' => $this->faker->numberBetween(10000, 35000),
            'Cake' => $this->faker->numberBetween(35000, 120000),
            'Strudel' => $this->faker->numberBetween(20000, 50000),
            'Catering' => $this->faker->numberBetween(25000, 50000),
            default => 25000,
        };

        return [
            'subcategory_id' => $subcategoryId,
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(4),
            'description' => $description,
            'image' => $this->faker->randomElement(self::$images),
            'price' => $basePrice,
            'stock' => $this->faker->numberBetween(10, 100),
            'is_best_seller' => $this->faker->boolean(30),
            'is_new_arrival' => $this->faker->boolean(40),
        ];
    }
}
