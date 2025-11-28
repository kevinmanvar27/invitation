<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Template Tag') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Edit Template Tag</h3>

                    <form method="POST" action="{{ route('admin.tags.update', $templateTag->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Template -->
                        <div class="mb-4">
                            <label for="template_id" class="block text-gray-700 text-sm font-bold mb-2">Template</label>
                            <select name="template_id" id="template_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a template</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}" {{ (old('template_id', $templateTag->template_id) == $template->id) ? 'selected' : '' }}>{{ $template->name }}</option>
                                @endforeach
                            </select>
                            @error('template_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tag Name -->
                        <div class="mb-4">
                            <label for="tag_name" class="block text-gray-700 text-sm font-bold mb-2">Tag Name</label>
                            <input type="text" name="tag_name" id="tag_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('tag_name', $templateTag->tag_name) }}" required>
                            @error('tag_name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.tags.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Tag
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>