<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Shared Invitation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Create New Shared Invitation</h3>

                    <form method="POST" action="{{ route('admin.shared-invitations.store') }}">
                        @csrf
                        
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

                        <!-- Share Method -->
                        <div class="mb-4">
                            <label for="share_method" class="block text-gray-700 text-sm font-bold mb-2">Share Method</label>
                            <select name="share_method" id="share_method" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select Share Method</option>
                                <option value="email" {{ old('share_method') == 'email' ? 'selected' : '' }}>Email</option>
                                <option value="sms" {{ old('share_method') == 'sms' ? 'selected' : '' }}>SMS</option>
                                <option value="link" {{ old('share_method') == 'link' ? 'selected' : '' }}>Link</option>
                            </select>
                            @error('share_method')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Recipient Email -->
                        <div class="mb-4">
                            <label for="recipient_email" class="block text-gray-700 text-sm font-bold mb-2">Recipient Email</label>
                            <input type="email" name="recipient_email" id="recipient_email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('recipient_email') }}" placeholder="recipient@example.com">
                            @error('recipient_email')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Recipient Phone -->
                        <div class="mb-4">
                            <label for="recipient_phone" class="block text-gray-700 text-sm font-bold mb-2">Recipient Phone</label>
                            <input type="text" name="recipient_phone" id="recipient_phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('recipient_phone') }}" placeholder="+1234567890">
                            @error('recipient_phone')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Share Token -->
                        <div class="mb-4">
                            <label for="share_token" class="block text-gray-700 text-sm font-bold mb-2">Share Token</label>
                            <input type="text" name="share_token" id="share_token" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('share_token') }}" placeholder="Unique share token">
                            @error('share_token')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- View Count -->
                        <div class="mb-4">
                            <label for="view_count" class="block text-gray-700 text-sm font-bold mb-2">View Count</label>
                            <input type="number" name="view_count" id="view_count" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('view_count', 0) }}" min="0">
                            @error('view_count')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.shared-invitations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Shared Invitation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>