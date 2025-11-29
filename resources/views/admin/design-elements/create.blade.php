<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Create Design Element') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <h3 class="text-lg font-medium mb-4">Add New Design Element</h3>

                    <form method="POST" action="{{ route('admin.design-elements.store') }}">
                        @csrf
                        
                        <!-- Name -->
                        <div class="mb-4">
                            <label for="name" class="block text-primary-dark text-sm font-bold mb-2">Name</label>
                            <input type="text" name="name" id="name" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}" required>
                            @error('name')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="mb-4">
                            <label for="type" class="block text-primary-dark text-sm font-bold mb-2">Type</label>
                            <input type="text" name="type" id="type" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('type') }}" required>
                            @error('type')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="mb-4">
                            <label for="category" class="block text-primary-dark text-sm font-bold mb-2">Category</label>
                            <input type="text" name="category" id="category" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('category') }}">
                            @error('category')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- SVG Path -->
                        <div class="mb-4">
                            <label for="svg_path" class="block text-primary-dark text-sm font-bold mb-2">SVG Path</label>
                            <input type="text" name="svg_path" id="svg_path" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('svg_path') }}">
                            @error('svg_path')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- PNG Path -->
                        <div class="mb-4">
                            <label for="png_path" class="block text-primary-dark text-sm font-bold mb-2">PNG Path</label>
                            <input type="text" name="png_path" id="png_path" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('png_path') }}">
                            @error('png_path')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Premium -->
                        <div class="mb-4">
                            <label class="block text-primary-dark text-sm font-bold mb-2">
                                <input type="checkbox" name="is_premium" id="is_premium" class="mr-2 leading-tight" {{ old('is_premium') ? 'checked' : '' }}>
                                Is Premium Element
                            </label>
                            @error('is_premium')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            <label for="tags" class="block text-primary-dark text-sm font-bold mb-2">Tags (comma separated)</label>
                            <input type="text" name="tags" id="tags" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('tags') }}">
                            @error('tags')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.design-elements.index') }}" class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Design Element
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>