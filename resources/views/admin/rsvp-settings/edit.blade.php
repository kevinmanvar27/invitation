<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit RSVP Setting') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Edit RSVP Setting</h3>

                    <form method="POST" action="{{ route('admin.rsvp-settings.update', $rsvpSetting->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Design -->
                        <div class="mb-4">
                            <label for="design_id" class="block text-gray-700 text-sm font-bold mb-2">Design</label>
                            <select name="design_id" id="design_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a Design</option>
                                @foreach($designs as $design)
                                    <option value="{{ $design->id }}" {{ (old('design_id', $rsvpSetting->design_id) == $design->id) ? 'selected' : '' }}>
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
                                    <option value="{{ $user->id }}" {{ (old('user_id', $rsvpSetting->user_id) == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- RSVP Enabled -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                <input type="checkbox" name="rsvp_enabled" id="rsvp_enabled" class="mr-2" {{ old('rsvp_enabled', $rsvpSetting->rsvp_enabled) ? 'checked' : '' }}>
                                RSVP Enabled
                            </label>
                            @error('rsvp_enabled')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deadline -->
                        <div class="mb-4">
                            <label for="deadline" class="block text-gray-700 text-sm font-bold mb-2">Deadline</label>
                            <input type="date" name="deadline" id="deadline" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('deadline', $rsvpSetting->deadline ? $rsvpSetting->deadline->format('Y-m-d') : '') }}">
                            @error('deadline')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Max Guests Per Invite -->
                        <div class="mb-4">
                            <label for="max_guests_per_invite" class="block text-gray-700 text-sm font-bold mb-2">Max Guests Per Invite</label>
                            <input type="number" name="max_guests_per_invite" id="max_guests_per_invite" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('max_guests_per_invite', $rsvpSetting->max_guests_per_invite) }}" min="1">
                            @error('max_guests_per_invite')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Collect Meal Preferences -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">
                                <input type="checkbox" name="collect_meal_preferences" id="collect_meal_preferences" class="mr-2" {{ old('collect_meal_preferences', $rsvpSetting->collect_meal_preferences) ? 'checked' : '' }}>
                                Collect Meal Preferences
                            </label>
                            @error('collect_meal_preferences')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Custom Questions -->
                        <div class="mb-4">
                            <label for="custom_questions" class="block text-gray-700 text-sm font-bold mb-2">Custom Questions (JSON format)</label>
                            <textarea name="custom_questions" id="custom_questions" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4">{{ old('custom_questions', json_encode($rsvpSetting->custom_questions)) }}</textarea>
                            <p class="text-gray-600 text-xs italic mt-1">Enter JSON array of custom questions, e.g., ["Dietary restrictions?", "Song requests?"]</p>
                            @error('custom_questions')
                                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.rsvp-settings.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update RSVP Setting
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>