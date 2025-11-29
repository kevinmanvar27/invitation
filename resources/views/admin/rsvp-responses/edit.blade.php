<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Edit RSVP Response') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <h3 class="text-lg font-medium mb-4">Edit RSVP Response</h3>

                    <form method="POST" action="{{ route('admin.rsvp-responses.update', $rsvpResponse->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Shared Invitation -->
                        <div class="mb-4">
                            <label for="shared_invitation_id" class="block text-primary-dark text-sm font-bold mb-2">Shared Invitation</label>
                            <select name="shared_invitation_id" id="shared_invitation_id" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a Shared Invitation</option>
                                @foreach($sharedInvitations as $sharedInvitation)
                                    <option value="{{ $sharedInvitation->id }}" {{ (old('shared_invitation_id', $rsvpResponse->shared_invitation_id) == $sharedInvitation->id) ? 'selected' : '' }}>
                                        Invitation #{{ $sharedInvitation->id }} - {{ $sharedInvitation->user->name ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('shared_invitation_id')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Guest Name -->
                        <div class="mb-4">
                            <label for="guest_name" class="block text-primary-dark text-sm font-bold mb-2">Guest Name</label>
                            <input type="text" name="guest_name" id="guest_name" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('guest_name', $rsvpResponse->guest_name) }}" required>
                            @error('guest_name')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Guest Email -->
                        <div class="mb-4">
                            <label for="guest_email" class="block text-primary-dark text-sm font-bold mb-2">Guest Email</label>
                            <input type="email" name="guest_email" id="guest_email" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('guest_email', $rsvpResponse->guest_email) }}">
                            @error('guest_email')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Guest Phone -->
                        <div class="mb-4">
                            <label for="guest_phone" class="block text-primary-dark text-sm font-bold mb-2">Guest Phone</label>
                            <input type="text" name="guest_phone" id="guest_phone" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('guest_phone', $rsvpResponse->guest_phone) }}">
                            @error('guest_phone')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Response -->
                        <div class="mb-4">
                            <label for="response" class="block text-primary-dark text-sm font-bold mb-2">Response</label>
                            <select name="response" id="response" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select Response</option>
                                <option value="yes" {{ (old('response', $rsvpResponse->response) == 'yes') ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ (old('response', $rsvpResponse->response) == 'no') ? 'selected' : '' }}>No</option>
                                <option value="maybe" {{ (old('response', $rsvpResponse->response) == 'maybe') ? 'selected' : '' }}>Maybe</option>
                            </select>
                            @error('response')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Plus Ones Count -->
                        <div class="mb-4">
                            <label for="plus_ones_count" class="block text-primary-dark text-sm font-bold mb-2">Plus Ones Count</label>
                            <input type="number" name="plus_ones_count" id="plus_ones_count" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('plus_ones_count', $rsvpResponse->plus_ones_count) }}" min="0">
                            @error('plus_ones_count')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Meal Preference -->
                        <div class="mb-4">
                            <label for="meal_preference" class="block text-primary-dark text-sm font-bold mb-2">Meal Preference</label>
                            <input type="text" name="meal_preference" id="meal_preference" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('meal_preference', $rsvpResponse->meal_preference) }}">
                            @error('meal_preference')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Special Requests -->
                        <div class="mb-4">
                            <label for="special_requests" class="block text-primary-dark text-sm font-bold mb-2">Special Requests</label>
                            <textarea name="special_requests" id="special_requests" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" rows="3">{{ old('special_requests', $rsvpResponse->special_requests) }}</textarea>
                            @error('special_requests')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Responded At -->
                        <div class="mb-4">
                            <label for="responded_at" class="block text-primary-dark text-sm font-bold mb-2">Responded At</label>
                            <input type="datetime-local" name="responded_at" id="responded_at" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('responded_at', $rsvpResponse->responded_at ? $rsvpResponse->responded_at->format('Y-m-d\TH:i') : '') }}">
                            @error('responded_at')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.rsvp-responses.index') }}" class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update RSVP Response
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>