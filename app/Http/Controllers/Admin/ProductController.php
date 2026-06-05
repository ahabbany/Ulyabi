<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('subcategory.category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category_id')) {
            $query->whereHas('subcategory', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::with('subcategories')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'subcategory_id' => 'required|exists:subcategories,id',
            'is_best_seller' => 'boolean',
            'is_new_arrival' => 'boolean',
            'variants' => 'nullable|array',
            'variants.*.name' => 'required_with:variants|max:255',
            'variants.*.additional_price' => 'nullable|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imageUrl = $this->uploadToCloudinary($request->file('image'));

        if (!$imageUrl) {
            return back()->withInput()->with('error', 'Upload gambar ke Cloudinary gagal. Periksa preset dan koneksi.');
        }

        $product = Product::create([
            'subcategory_id' => $validated['subcategory_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(6),
            'description' => $validated['description'],
            'image' => $imageUrl,
            'price' => $validated['price'],
            'is_best_seller' => $request->boolean('is_best_seller'),
            'is_new_arrival' => $request->boolean('is_new_arrival'),
        ]);

        if ($request->filled('variants')) {
            foreach ($request->variants as $variantData) {
                $product->variants()->create([
                    'name' => $variantData['name'],
                    'additional_price' => $variantData['additional_price'] ?? 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        $product->load('subcategory.category', 'variants');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $product->load('variants');
        $categories = Category::with('subcategories')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'subcategory_id' => 'required|exists:subcategories,id',
            'is_best_seller' => 'boolean',
            'is_new_arrival' => 'boolean',
            'variants' => 'nullable|array',
            'variants.*.name' => 'required_with:variants|max:255',
            'variants.*.additional_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'subcategory_id' => $validated['subcategory_id'],
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']) . '-' . Str::random(6),
            'description' => $validated['description'],
            'price' => $validated['price'],
            'is_best_seller' => $request->boolean('is_best_seller'),
            'is_new_arrival' => $request->boolean('is_new_arrival'),
        ];

        if ($request->file('image')) {
            $imageUrl = $this->uploadToCloudinary($request->file('image'));

            if (!$imageUrl) {
                return back()->withInput()->with('error', 'Upload gambar ke Cloudinary gagal. Periksa preset dan koneksi.');
            }

            $data['image'] = $imageUrl;
        }

        $product->update($data);

        $product->variants()->delete();

        if ($request->filled('variants')) {
            foreach ($request->variants as $variantData) {
                $product->variants()->create([
                    'name' => $variantData['name'],
                    'additional_price' => $variantData['additional_price'] ?? 0,
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    private function uploadToCloudinary($file)
    {
        $cloudName = env('CLOUDINARY_CLOUD_NAME');

        if (!$cloudName) {
            return null;
        }

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => "https://api.cloudinary.com/v1_1/$cloudName/image/upload",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'file' => curl_file_create($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName()),
                'upload_preset' => 'unsigned_upload',
            ],
            CURLOPT_TIMEOUT => 30,
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error || $httpCode !== 200) {
            return null;
        }

        $result = json_decode($response, true);

        return $result['secure_url'] ?? null;
    }
}