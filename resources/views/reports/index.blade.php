@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Inventory Reports</h1>
            <p class="text-sm text-gray-500">Operational overview of stock levels and recent movements.</p>
        </div>
        <a href="{{ route('products.index') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm font-semibold">
            Manage Inventory
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
            <p class="text-sm text-gray-500 uppercase tracking-wide">Total Products</p>
            <p class="mt-2 text-3xl font-bold text-gray-900">{{ $products->count() }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
            <p class="text-sm text-gray-500 uppercase tracking-wide">Low Stock Items</p>
            <p class="mt-2 text-3xl font-bold text-amber-600">{{ $lowStockProducts->count() }}</p>
        </div>
        <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
            <p class="text-sm text-gray-500 uppercase tracking-wide">Inventory Value</p>
            <p class="mt-2 text-3xl font-bold text-emerald-700">₱{{ number_format($totalInventoryValue, 2) }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800">Low Stock Alert</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($lowStockProducts as $product)
                    <div class="px-6 py-4 flex items-center justify-between">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $product->name }}</p>
                            <p class="text-sm text-gray-500">SKU: {{ $product->sku }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-amber-700">{{ $product->quantity }} left</p>
                            <p class="text-xs text-gray-500">Reorder at {{ $product->reorder_level }}</p>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-4 text-sm text-gray-500">No low stock products at the moment.</div>
                @endforelse
            </div>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-800">Recent Transactions</h2>
            </div>
            <div class="divide-y divide-gray-200">
                @forelse($transactions as $transaction)
                    <div class="px-6 py-4">
                        <div class="flex items-center justify-between gap-3">
                            <p class="font-semibold text-gray-900">{{ $transaction->product?->name ?? 'Unknown Product' }}</p>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $transaction->type === 'stock_in' ? 'bg-emerald-100 text-emerald-700' : ($transaction->type === 'stock_out' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700') }}">
                                {{ str_replace('_', ' ', ucfirst($transaction->type)) }}
                            </span>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">
                            Quantity: {{ $transaction->quantity }} • {{ $transaction->user?->name ?? 'System' }} • {{ $transaction->created_at->format('M d, Y H:i') }}
                        </p>
                    </div>
                @empty
                    <div class="px-6 py-4 text-sm text-gray-500">No recent transactions available.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
