<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Category</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border border-gray-200">
                <form action="{{ route('categories.update', $category) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    @if($errors->any())
                        <div class="rounded-md border border-red-300 bg-red-50 px-4 py-3 text-sm text-red-700" role="alert">
                            <p class="font-semibold">Hindi na-update ang category. Pakisuri ang mga sumusunod:</p>
                            <ul class="mt-2 list-disc pl-5">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $category->name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" rows="3" name="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('description', $category->description) }}</textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('categories.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm">Cancel</a>
                        <button type="submit" class="bg-emerald-600 text-white px-4 py-2 rounded-md text-sm font-semibold hover:bg-emerald-700">Update Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
