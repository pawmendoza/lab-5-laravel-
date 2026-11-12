<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Brand Management</h2>
            <a href="{{ route('brands.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-md text-sm font-semibold shadow">+ Add Brand</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">{{ session('success') }}</div>
                @endif
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-900 text-white text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3 text-left">#</th>
                                <th class="px-6 py-3 text-left">Brand Name</th>
                                <th class="px-6 py-3 text-left">Description</th>
                                <th class="px-6 py-3 text-center">Products</th>
                                <th class="px-6 py-3 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @forelse($brands as $index => $brand)
                                <tr>
                                    <td class="px-6 py-4">{{ $brands->firstItem() + $index }}</td>
                                    <td class="px-6 py-4 font-semibold text-gray-900">{{ $brand->name }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $brand->description ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2.5 py-1 text-xs font-bold bg-cyan-100 text-cyan-800 rounded-full">{{ $brand->products_count }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-right space-x-2">
                                        <a href="{{ route('brands.edit', $brand->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this brand?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">No brands found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $brands->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>