<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('subcategories')->get();
        $bestSellers = Product::with('subcategory.category')
            ->where('is_best_seller', true)
            ->take(8)
            ->get();
        $newArrivals = Product::with('subcategory.category')
            ->where('is_new_arrival', true)
            ->latest()
            ->take(8)
            ->get();

        return view('home.index', compact('categories', 'bestSellers', 'newArrivals'));
    }
}
