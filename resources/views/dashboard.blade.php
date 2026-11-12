<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-emerald-600 flex justify-between items-center">
                    <div>
                        <div class="text-sm font-medium text-gray-500">Total Products</div>
                        <div class="text-3xl font-bold text-gray-900 mt-2">{{ $totalProducts }}</div>
                    </div>
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                    </div>
                </div>

                
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-amber-500 flex justify-between items-center">
                    <div>
                        <div class="text-sm font-medium text-gray-500">Low Stock</div>
                        <div class="text-3xl font-bold text-amber-600 mt-2">{{ $lowStockCount }}</div>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                </div>

                
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-red-500 flex justify-between items-center">
                    <div>
                        <div class="text-sm font-medium text-gray-500">Out of Stock</div>
                        <div class="text-3xl font-bold text-red-600 mt-2">{{ $outOfStockCount }}</div>
                    </div>
                    <div class="p-3 bg-red-50 text-red-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>

                
                <div class="bg-white p-6 rounded-lg shadow-sm border-l-4 border-blue-600 flex justify-between items-center">
                    <div>
                        <div class="text-sm font-medium text-gray-500">Inventory Value</div>
                        <div class="text-2xl font-bold text-blue-700 mt-2">₱{{ number_format($totalValue, 2) }}</div>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-full">
                        <span class="text-xl font-bold">₱</span>
                    </div>
                </div>
            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Recent Products
                        </h3>
                        <a href="{{ route('products.index') }}" class="text-xs bg-gray-200 hover:bg-gray-300 text-gray-700 px-3 py-1 rounded font-semibold transition">View All</a>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse($recentProducts as $product)
                            <div class="px-6 py-3 flex justify-between items-center hover:bg-gray-50">
                                <div>
                                    <div class="font-semibold text-gray-900 text-sm">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $product->sku }} - {{ $product->category?->name ?? 'No Category' }}</div>
                                </div>
                                <span class="px-2.5 py-1 text-xs font-bold bg-gray-100 text-gray-700 rounded-full">{{ $product->quantity }} pcs</span>
                            </div>
                        @empty
                            <div class="p-6 text-center text-sm text-gray-500">No products found.</div>
                        @endforelse
                    </div>
                </div>

                
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-amber-50">
                        <h3 class="font-bold text-amber-900 flex items-center gap-2">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Low Stock Alerts
                        </h3>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @forelse($lowStockProducts as $product)
                            <div class="px-6 py-3 flex justify-between items-center hover:bg-gray-50">
                                <div>
                                    <div class="font-semibold text-gray-900 text-sm">{{ $product->name }}</div>
                                    <div class="text-xs text-gray-500">Reorder at {{ $product->reorder_level }}</div>
                                </div>
                                <span class="px-2.5 py-1 text-xs font-bold bg-amber-100 text-amber-800 rounded-full">{{ $product->quantity }} left</span>
                            </div>
                        @empty
                            <div class="p-6 text-center text-sm text-gray-500">No low stock alerts.</div>
                        @endforelse
                    </div>
                </div>

            </div>

            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                
                
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">Brands</h3>
                        <span class="text-xs bg-emerald-600 text-white px-2.5 py-1 rounded-full font-semibold">{{ $brands->count() }} total</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100 text-gray-600 text-xs uppercase">
                                <tr>
                                    <th class="px-4 py-3 text-left">ID</th>
                                    <th class="px-4 py-3 text-left">Brand Name</th>
                                    <th class="px-4 py-3 text-left">Description</th>
                                    <th class="px-4 py-3 text-center">Products</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($brands as $brand)
                                    <tr>
                                        <td class="px-4 py-3 text-gray-500">{{ $brand->id }}</td>
                                        <td class="px-4 py-3 font-semibold text-gray-900">{{ $brand->name }}</td>
                                        <td class="px-4 py-3 text-gray-500 truncate max-w-xs">{{ $brand->description ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="px-2 py-1 text-xs bg-gray-100 rounded-full font-bold">{{ $brand->products_count }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">No brands found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">Categories</h3>
                        <span class="text-xs bg-emerald-600 text-white px-2.5 py-1 rounded-full font-semibold">{{ $categories->count() }} total</span>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100 text-gray-600 text-xs uppercase">
                                <tr>
                                    <th class="px-4 py-3 text-left">ID</th>
                                    <th class="px-4 py-3 text-left">Category Name</th>
                                    <th class="px-4 py-3 text-left">Description</th>
                                    <th class="px-4 py-3 text-center">Products</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="px-4 py-3 text-gray-500">{{ $category->id }}</td>
                                        <td class="px-4 py-3 font-semibold text-gray-900">{{ $category->name }}</td>
                                        <td class="px-4 py-3 text-gray-500 truncate max-w-xs">{{ $category->description ?? 'N/A' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span class="px-2 py-1 text-xs bg-gray-100 rounded-full font-bold">{{ $category->products_count }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="px-4 py-4 text-center text-gray-500">No categories found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>