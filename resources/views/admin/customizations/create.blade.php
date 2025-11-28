<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User Customization') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Add New User Customization</h3>

                    <form method="POST" action="{{ route('admin.customizations.store') }}">
                        @csrf
                        
                        <!-- Design -->
                        <div class="mb-4">
                            <label for="design_id" class="block text-gray-700 text-sm font-bold mb-2">Design</label>
                            <select name="design_id" id="design_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a Design</option>
                                @foreach($designs as $design)
                                    <option value="{{ $design->id }}" {{ old('design_id') == $design->id ? 'selected' : '' }}>{{ $design->design_name }} (User: {{ $design->user->name ?? 'N/A' }})</option>
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
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bride Name -->
                        <div class="mb-4">
                            <label for="bride_name" class="block text-gray-700 text-sm font-bold mb-2">Bride Name</label>
                            <input type="text" name="bride_name" id="bride_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('bride_name') }}">
                            @error('bride_name')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Groom Name -->
                        <div class="mb-4">
                            <label for="groom_name" class="block text-gray-700 text-sm font-bold mb-2">Groom Name</label>
                            <input type="text" name="groom_name" id="groom_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('groom_name') }}">
                            @error('groom_name')
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

                        <!-- Wedding Time -->
                        <div class="mb-4">
                            <label for="wedding_time" class="block text-gray-700 text-sm font-bold mb-2">Wedding Time</label>
                            <input type="time" name="wedding_time" id="wedding_time" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('wedding_time') }}">
                            @error('wedding_time')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Venue -->
                        <div class="mb-4">
                            <label for="venue" class="block text-gray-700 text-sm font-bold mb-2">Venue</label>
                            <input type="text" name="venue" id="venue" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('venue') }}">
                            @error('venue')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Language -->
                        <div class="mb-4">
                            <label for="language" class="block text-gray-700 text-sm font-bold mb-2">Language</label>
                            <select name="language" id="language" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="en" {{ old('language') == 'en' ? 'selected' : '' }}>English</option>
                                <option value="es" {{ old('language') == 'es' ? 'selected' : '' }}>Spanish</option>
                                <option value="fr" {{ old('language') == 'fr' ? 'selected' : '' }}>French</option>
                            </select>
                            @error('language')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Wording Style -->
                        <div class="mb-4">
                            <label for="wording_style" class="block text-gray-700 text-sm font-bold mb-2">Wording Style</label>
                            <select name="wording_style" id="wording_style" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="formal" {{ old('wording_style') == 'formal' ? 'selected' : '' }}>Formal</option>
                                <option value="casual" {{ old('wording_style') == 'casual' ? 'selected' : '' }}>Casual</option>
                                <option value="traditional" {{ old('wording_style') == 'traditional' ? 'selected' : '' }}>Traditional</option>
                            </select>
                            @error('wording_style')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- RSVP Enabled -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                <input type="checkbox" name="rsvp_enabled" id="rsvp_enabled" class="mr-2 leading-tight" {{ old('rsvp_enabled') ? 'checked' : '' }}>
                                RSVP Enabled
                            </label>
                            @error('rsvp_enabled')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- RSVP Deadline -->
                        <div class="mb-4">
                            <label for="rsvp_deadline" class="block text-gray-700 text-sm font-bold mb-2">RSVP Deadline</label>
                            <input type="date" name="rsvp_deadline" id="rsvp_deadline" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('rsvp_deadline') }}">
                            @error('rsvp_deadline')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.customizations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Customization
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>