<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSubcategories = Subcategory::count();
        $totalBestSellers = Product::where('is_best_seller', true)->count();
        $totalNewArrivals = Product::where('is_new_arrival', true)->count();

        $productsPerCategory = Category::withCount('subcategories as total_products')
            ->get()
            ->map(function ($category) {
                $count = Product::whereHas('subcategory', function ($q) use ($category) {
                    $q->where('category_id', $category->id);
                })->count();
                $category->products_count = $count;
                return $category;
            });

        $recentProducts = Product::with('subcategory.category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSubcategories',
            'totalBestSellers',
            'totalNewArrivals',
            'productsPerCategory',
            'recentProducts'
        ));
    }
}
