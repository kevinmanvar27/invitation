<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Edit Shipping Address') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <h3 class="text-lg font-medium mb-4">Edit Shipping Address</h3>

                    <form method="POST" action="{{ route('admin.shipping-addresses.update', $shippingAddress->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- User -->
                        <div class="mb-4">
                            <label for="user_id" class="block text-primary-dark text-sm font-bold mb-2">User</label>
                            <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ (old('user_id', $shippingAddress->user_id) == $user->id) ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Name -->
                        <div class="mb-4">
                            <label for="full_name" class="block text-primary-dark text-sm font-bold mb-2">Full Name</label>
                            <input type="text" name="full_name" id="full_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('full_name', $shippingAddress->full_name) }}" required>
                            @error('full_name')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div class="mb-4">
                            <label for="phone" class="block text-primary-dark text-sm font-bold mb-2">Phone</label>
                            <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('phone', $shippingAddress->phone) }}" required>
                            @error('phone')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address Line 1 -->
                        <div class="mb-4">
                            <label for="address_line1" class="block text-primary-dark text-sm font-bold mb-2">Address Line 1</label>
                            <input type="text" name="address_line1" id="address_line1" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('address_line1', $shippingAddress->address_line1) }}" required>
                            @error('address_line1')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address Line 2 -->
                        <div class="mb-4">
                            <label for="address_line2" class="block text-primary-dark text-sm font-bold mb-2">Address Line 2</label>
                            <input type="text" name="address_line2" id="address_line2" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('address_line2', $shippingAddress->address_line2) }}">
                            @error('address_line2')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- City -->
                        <div class="mb-4">
                            <label for="city" class="block text-primary-dark text-sm font-bold mb-2">City</label>
                            <input type="text" name="city" id="city" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('city', $shippingAddress->city) }}" required>
                            @error('city')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- State -->
                        <div class="mb-4">
                            <label for="state" class="block text-primary-dark text-sm font-bold mb-2">State</label>
                            <input type="text" name="state" id="state" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('state', $shippingAddress->state) }}" required>
                            @error('state')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Postal Code -->
                        <div class="mb-4">
                            <label for="postal_code" class="block text-primary-dark text-sm font-bold mb-2">Postal Code</label>
                            <input type="text" name="postal_code" id="postal_code" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('postal_code', $shippingAddress->postal_code) }}" required>
                            @error('postal_code')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Country -->
                        <div class="mb-4">
                            <label for="country" class="block text-primary-dark text-sm font-bold mb-2">Country</label>
                            <input type="text" name="country" id="country" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('country', $shippingAddress->country) }}" required>
                            @error('country')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Is Default -->
                        <div class="mb-4">
                            <label class="block text-primary-dark text-sm font-bold mb-2">
                                <input type="checkbox" name="is_default" id="is_default" class="mr-2" {{ old('is_default', $shippingAddress->is_default) ? 'checked' : '' }}>
                                Set as Default Address
                            </label>
                            @error('is_default')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.shipping-addresses.index') }}" class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Shipping Address
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>