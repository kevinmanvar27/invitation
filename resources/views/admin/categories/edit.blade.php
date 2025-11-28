<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Template Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Edit Template Category</h3>

                    <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name', $category->name) }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="mb-4">
                            <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
                            <input type="text" name="slug" id="slug" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('slug', $category->slug) }}" required>
                            @error('slug')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Parent Category -->
                        <div class="mb-4">
                            <label for="parent_id" class="block text-gray-700 text-sm font-bold mb-2">Parent Category</label>
                            <select name="parent_id" id="parent_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">None (Top Level)</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Order -->
                        <div class="mb-4">
                            <label for="order" class="block text-gray-700 text-sm font-bold mb-2">Order</label>
                            <input type="number" name="order" id="order" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('order', $category->order) }}">
                            @error('order')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div class="mb-4">
                            <label for="icon" class="block text-gray-700 text-sm font-bold mb-2">Icon</label>
                            <input type="text" name="icon" id="icon" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('icon', $category->icon) }}">
                            @error('icon')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3">{{ old('description', $category->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>