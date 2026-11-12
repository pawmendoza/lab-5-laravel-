<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\InventoryTransaction;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $lowStockProducts = $products->filter(fn($product) => $product->quantity <= $product->reorder_level);
        $transactions = InventoryTransaction::with(['product', 'user'])->latest()->take(50)->get();
        $totalInventoryValue = $products->sum(fn($product) => $product->quantity * $product->unit_price);

        return view('reports.index', compact('products', 'lowStockProducts', 'transactions', 'totalInventoryValue'));
    }
}