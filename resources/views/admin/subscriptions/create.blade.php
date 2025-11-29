<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Create Subscription') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <h3 class="text-lg font-medium mb-4">Create New Subscription</h3>

                    <form method="POST" action="{{ route('admin.subscriptions.store') }}">
                        @csrf
                        
                        <!-- User -->
                        <div class="mb-4">
                            <label for="user_id" class="block text-primary-dark text-sm font-bold mb-2">User</label>
                            <select name="user_id" id="user_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Plan Type -->
                        <div class="mb-4">
                            <label for="plan_type" class="block text-primary-dark text-sm font-bold mb-2">Plan Type</label>
                            <select name="plan_type" id="plan_type" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a Plan</option>
                                <option value="basic" {{ old('plan_type') == 'basic' ? 'selected' : '' }}>Basic</option>
                                <option value="premium" {{ old('plan_type') == 'premium' ? 'selected' : '' }}>Premium</option>
                                <option value="enterprise" {{ old('plan_type') == 'enterprise' ? 'selected' : '' }}>Enterprise</option>
                            </select>
                            @error('plan_type')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Price -->
                        <div class="mb-4">
                            <label for="price" class="block text-primary-dark text-sm font-bold mb-2">Price</label>
                            <input type="number" step="0.01" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('price') }}" required>
                            @error('price')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Currency -->
                        <div class="mb-4">
                            <label for="currency" class="block text-primary-dark text-sm font-bold mb-2">Currency</label>
                            <select name="currency" id="currency" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="USD" {{ old('currency') == 'USD' ? 'selected' : '' }}>USD</option>
                                <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR</option>
                                <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP</option>
                            </select>
                            @error('currency')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-primary-dark text-sm font-bold mb-2">Status</label>
                            <select name="status" id="status" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                            @error('status')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Started At -->
                        <div class="mb-4">
                            <label for="started_at" class="block text-primary-dark text-sm font-bold mb-2">Started At</label>
                            <input type="date" name="started_at" id="started_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('started_at') }}" required>
                            @error('started_at')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Expires At -->
                        <div class="mb-4">
                            <label for="expires_at" class="block text-primary-dark text-sm font-bold mb-2">Expires At</label>
                            <input type="date" name="expires_at" id="expires_at" class="shadow appearance-none border rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('expires_at') }}" required>
                            @error('expires_at')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.subscriptions.index') }}" class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Subscription
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>