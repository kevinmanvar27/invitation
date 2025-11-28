<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Design Element') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Edit Design Element</h3>

                    <form method="POST" action="{{ route('admin.design-elements.update', $designElement->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name', $designElement->name) }}" required>
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="mb-4">
                            <label for="type" class="block text-gray-700 text-sm font-bold mb-2">Type</label>
                            <input type="text" name="type" id="type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('type', $designElement->type) }}" required>
                            @error('type')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                            <input type="text" name="category" id="category" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('category', $designElement->category) }}">
                            @error('category')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SVG Path -->
                        <div class="mb-4">
                            <label for="svg_path" class="block text-gray-700 text-sm font-bold mb-2">SVG Path</label>
                            <input type="text" name="svg_path" id="svg_path" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('svg_path', $designElement->svg_path) }}">
                            @error('svg_path')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- PNG Path -->
                        <div class="mb-4">
                            <label for="png_path" class="block text-gray-700 text-sm font-bold mb-2">PNG Path</label>
                            <input type="text" name="png_path" id="png_path" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('png_path', $designElement->png_path) }}">
                            @error('png_path')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Premium -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                <input type="checkbox" name="is_premium" id="is_premium" class="mr-2 leading-tight" {{ old('is_premium', $designElement->is_premium) ? 'checked' : '' }}>
                                Is Premium Element
                            </label>
                            @error('is_premium')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            <label for="tags" class="block text-gray-700 text-sm font-bold mb-2">Tags (comma separated)</label>
                            <input type="text" name="tags" id="tags" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('tags', is_array($designElement->tags) ? implode(',', $designElement->tags) : $designElement->tags) }}">
                            @error('tags')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.design-elements.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Design Element
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>