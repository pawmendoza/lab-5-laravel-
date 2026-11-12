<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardApiController extends Controller
{
    public function show(Product $product)
    {
        $transactions = $product->inventoryTransactions()->with(['user', 'product'])->oldest()->get();

        return view('products.show', compact('product', 'transactions'));
    }
}