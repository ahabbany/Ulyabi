<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->get();
        $products = Product::with('subcategory.category');

        if ($categorySlug = request('category')) {
            $category = Category::where('slug', $categorySlug)->first();
            if ($category) {
                $products->whereHas('subcategory', function ($q) use ($category) {
                    $q->where('category_id', $category->id);
                });
            }
        }

        if ($subcategorySlug = request('subcategory')) {
            $products->whereHas('subcategory', function ($q) use ($subcategorySlug) {
                $q->where('slug', $subcategorySlug);
            });
        }

        if ($search = request('search')) {
            $products->where('name', 'like', "%{$search}%");
        }

        if ($sort = request('sort')) {
            if ($sort === 'price_asc') {
                $products->orderBy('price');
            } elseif ($sort === 'price_desc') {
                $products->orderByDesc('price');
            }
        } else {
            $products->latest();
        }

        $products = $products->paginate(12)->withQueryString();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with('subcategory.category')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::with('subcategory.category')
            ->where('subcategory_id', $product->subcategory_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
