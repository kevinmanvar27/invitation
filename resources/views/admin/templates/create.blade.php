<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Template') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Add New Template</h3>

                    <form method="POST" action="{{ route('admin.templates.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Slug -->
                        <div class="mb-4">
                            <label for="slug" class="block text-gray-700 text-sm font-bold mb-2">Slug</label>
                            <input type="text" name="slug" id="slug" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('slug') }}" required>
                            @error('slug')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                            <textarea name="description" id="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="3">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                            <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Theme -->
                        <div class="mb-4">
                            <label for="theme" class="block text-gray-700 text-sm font-bold mb-2">Theme</label>
                            <input type="text" name="theme" id="theme" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('theme') }}">
                            @error('theme')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Style -->
                        <div class="mb-4">
                            <label for="style" class="block text-gray-700 text-sm font-bold mb-2">Style</label>
                            <input type="text" name="style" id="style" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('style') }}">
                            @error('style')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Orientation -->
                        <div class="mb-4">
                            <label for="orientation" class="block text-gray-700 text-sm font-bold mb-2">Orientation</label>
                            <select name="orientation" id="orientation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="portrait" {{ old('orientation') == 'portrait' ? 'selected' : '' }}>Portrait</option>
                                <option value="landscape" {{ old('orientation') == 'landscape' ? 'selected' : '' }}>Landscape</option>
                            </select>
                            @error('orientation')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Premium -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                <input type="hidden" name="is_premium" value="0">
                                <input type="checkbox" name="is_premium" id="is_premium" class="mr-2 leading-tight" value="1" {{ old('is_premium') ? 'checked' : '' }}>
                                Is Premium Template
                            </label>
                            @error('is_premium')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                            <input type="number" step="0.01" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('price', 0) }}">
                            @error('price')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Active -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" id="is_active" class="mr-2 leading-tight" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                Is Active
                            </label>
                            @error('is_active')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.templates.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Template
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>