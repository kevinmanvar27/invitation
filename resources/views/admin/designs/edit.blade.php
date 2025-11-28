<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User Design') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Edit User Design</h3>

                    <form method="POST" action="{{ route('admin.designs.update', $userDesign->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- User -->
                        <div class="mb-4">
                            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">User</label>
                            <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $userDesign->user_id) == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Template -->
                        <div class="mb-4">
                            <label for="template_id" class="block text-gray-700 text-sm font-bold mb-2">Template</label>
                            <select name="template_id" id="template_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a Template</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->id }}" {{ old('template_id', $userDesign->template_id) == $template->id ? 'selected' : '' }}>{{ $template->name }}</option>
                                @endforeach
                            </select>
                            @error('template_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Design Name -->
                        <div class="mb-4">
                            <label for="design_name" class="block text-gray-700 text-sm font-bold mb-2">Design Name</label>
                            <input type="text" name="design_name" id="design_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('design_name', $userDesign->design_name) }}" required>
                            @error('design_name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status</label>
                            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="draft" {{ old('status', $userDesign->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="completed" {{ old('status', $userDesign->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="published" {{ old('status', $userDesign->status) == 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Is Completed -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                <input type="checkbox" name="is_completed" id="is_completed" class="mr-2 leading-tight" {{ old('is_completed', $userDesign->is_completed) ? 'checked' : '' }}>
                                Is Completed
                            </label>
                            @error('is_completed')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.designs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Design
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>