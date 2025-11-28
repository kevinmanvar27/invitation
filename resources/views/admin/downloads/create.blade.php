<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Download') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Create New Download</h3>

                    <form method="POST" action="{{ route('admin.downloads.store') }}">
                        @csrf
                        
                        <!-- User -->
                        <div class="mb-4">
                            <label for="user_id" class="block text-gray-700 text-sm font-bold mb-2">User</label>
                            <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Design -->
                        <div class="mb-4">
                            <label for="design_id" class="block text-gray-700 text-sm font-bold mb-2">Design</label>
                            <select name="design_id" id="design_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a Design</option>
                                @foreach($designs as $design)
                                    <option value="{{ $design->id }}" {{ old('design_id') == $design->id ? 'selected' : '' }}>
                                        {{ $design->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('design_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Type -->
                        <div class="mb-4">
                            <label for="file_type" class="block text-gray-700 text-sm font-bold mb-2">File Type</label>
                            <select name="file_type" id="file_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select File Type</option>
                                <option value="jpg" {{ old('file_type') == 'jpg' ? 'selected' : '' }}>JPG</option>
                                <option value="png" {{ old('file_type') == 'png' ? 'selected' : '' }}>PNG</option>
                                <option value="pdf" {{ old('file_type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                                <option value="svg" {{ old('file_type') == 'svg' ? 'selected' : '' }}>SVG</option>
                            </select>
                            @error('file_type')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Resolution -->
                        <div class="mb-4">
                            <label for="resolution" class="block text-gray-700 text-sm font-bold mb-2">Resolution</label>
                            <input type="text" name="resolution" id="resolution" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('resolution') }}" placeholder="e.g. 1920x1080">
                            @error('resolution')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Size -->
                        <div class="mb-4">
                            <label for="file_size" class="block text-gray-700 text-sm font-bold mb-2">File Size (bytes)</label>
                            <input type="number" name="file_size" id="file_size" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('file_size') }}">
                            @error('file_size')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- File Path -->
                        <div class="mb-4">
                            <label for="file_path" class="block text-gray-700 text-sm font-bold mb-2">File Path</label>
                            <input type="text" name="file_path" id="file_path" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('file_path') }}" placeholder="path/to/file">
                            @error('file_path')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Download Count -->
                        <div class="mb-4">
                            <label for="download_count" class="block text-gray-700 text-sm font-bold mb-2">Download Count</label>
                            <input type="number" name="download_count" id="download_count" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('download_count', 0) }}" min="0">
                            @error('download_count')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.downloads.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Download
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>