<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Create New User Profile</h3>

                    <form method="POST" action="{{ route('admin.user-profiles.store') }}" enctype="multipart/form-data">
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

                        <!-- Partner Name -->
                        <div class="mb-4">
                            <label for="partner_name" class="block text-gray-700 text-sm font-bold mb-2">Partner Name</label>
                            <input type="text" name="partner_name" id="partner_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('partner_name') }}">
                            @error('partner_name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Wedding Date -->
                        <div class="mb-4">
                            <label for="wedding_date" class="block text-gray-700 text-sm font-bold mb-2">Wedding Date</label>
                            <input type="date" name="wedding_date" id="wedding_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('wedding_date') }}">
                            @error('wedding_date')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="mb-4">
                            <label for="profile_picture" class="block text-gray-700 text-sm font-bold mb-2">Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('profile_picture')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preferences -->
                        <div class="mb-4">
                            <label for="preferences" class="block text-gray-700 text-sm font-bold mb-2">Preferences (JSON format)</label>
                            <textarea name="preferences" id="preferences" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4">{{ old('preferences') }}</textarea>
                            <p class="text-gray-600 text-xs italic mt-1">Enter JSON object of user preferences</p>
                            @error('preferences')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.user-profiles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create User Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>