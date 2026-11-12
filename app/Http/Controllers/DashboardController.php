<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $lowStockCount = Product::lowStock()->count();
        $outOfStockCount = Product::outOfStock()->count();
        $totalValue = Product::sum(DB::raw('quantity * unit_price'));

        $recentProducts = Product::with(['category', 'brand'])->latest()->take(5)->get();
        $lowStockProducts = Product::with(['category', 'brand'])->lowStock()->take(5)->get();

        $brands = Brand::withCount('products')->get();
        $categories = Category::withCount('products')->get();

        return view('dashboard', compact(
            'totalProducts',
            'lowStockCount',
            'outOfStockCount',
            'totalValue',
            'recentProducts',
            'lowStockProducts',
            'brands',
            'categories'
        ));
    }
}