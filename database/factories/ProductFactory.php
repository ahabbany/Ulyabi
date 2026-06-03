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
            'image' => '',
            'price' => $basePrice,
            'stock' => $this->faker->numberBetween(10, 100),
            'is_best_seller' => $this->faker->boolean(30),
            'is_new_arrival' => $this->faker->boolean(40),
        ];
    }
}
