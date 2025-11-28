<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Font') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Edit Font</h3>

                    <form method="POST" action="{{ route('admin.fonts.update', $font->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Font Name -->
                        <div class="mb-4">
                            <label for="font_name" class="block text-gray-700 text-sm font-bold mb-2">Font Name</label>
                            <input type="text" name="font_name" id="font_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('font_name', $font->font_name) }}" required>
                            @error('font_name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Font Family -->
                        <div class="mb-4">
                            <label for="font_family" class="block text-gray-700 text-sm font-bold mb-2">Font Family</label>
                            <input type="text" name="font_family" id="font_family" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('font_family', $font->font_family) }}" required>
                            @error('font_family')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Font File Path -->
                        <div class="mb-4">
                            <label for="font_file_path" class="block text-gray-700 text-sm font-bold mb-2">Font File Path</label>
                            <input type="text" name="font_file_path" id="font_file_path" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('font_file_path', $font->font_file_path) }}">
                            @error('font_file_path')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Font Weight -->
                        <div class="mb-4">
                            <label for="font_weight" class="block text-gray-700 text-sm font-bold mb-2">Font Weight</label>
                            <input type="text" name="font_weight" id="font_weight" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('font_weight', $font->font_weight) }}">
                            @error('font_weight')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Premium -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                <input type="checkbox" name="is_premium" id="is_premium" class="mr-2 leading-tight" {{ old('is_premium', $font->is_premium) ? 'checked' : '' }}>
                                Is Premium Font
                            </label>
                            @error('is_premium')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Language Support -->
                        <div class="mb-4">
                            <label for="language_support" class="block text-gray-700 text-sm font-bold mb-2">Language Support (comma separated)</label>
                            <input type="text" name="language_support" id="language_support" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('language_support', is_array($font->language_support) ? implode(',', $font->language_support) : $font->language_support) }}">
                            @error('language_support')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.fonts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Font
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>