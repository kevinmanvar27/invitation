<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Edit Coupon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <h3 class="text-lg font-medium mb-4">Edit Coupon</h3>

                    <form method="POST" action="{{ route('admin.coupons.update', $coupon->id) }}">
                        @csrf
                        @method('PUT')
                        
                        <!-- Code -->
                        <div class="mb-4">
                            <label for="code" class="block text-primary-dark text-sm font-bold mb-2">Coupon Code</label>
                            <input type="text" name="code" id="code" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('code', $coupon->code) }}" required>
                            @error('code')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Discount Type -->
                        <div class="mb-4">
                            <label for="discount_type" class="block text-primary-dark text-sm font-bold mb-2">Discount Type</label>
                            <select name="discount_type" id="discount_type" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select Discount Type</option>
                                <option value="percentage" {{ (old('discount_type', $coupon->discount_type) == 'percentage') ? 'selected' : '' }}>Percentage</option>
                                <option value="fixed" {{ (old('discount_type', $coupon->discount_type) == 'fixed') ? 'selected' : '' }}>Fixed Amount</option>
                            </select>
                            @error('discount_type')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Discount Value -->
                        <div class="mb-4">
                            <label for="discount_value" class="block text-primary-dark text-sm font-bold mb-2">Discount Value</label>
                            <input type="number" step="0.01" name="discount_value" id="discount_value" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('discount_value', $coupon->discount_value) }}" required>
                            @error('discount_value')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Min Purchase -->
                        <div class="mb-4">
                            <label for="min_purchase" class="block text-primary-dark text-sm font-bold mb-2">Minimum Purchase ($)</label>
                            <input type="number" step="0.01" name="min_purchase" id="min_purchase" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('min_purchase', $coupon->min_purchase) }}">
                            @error('min_purchase')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Valid From -->
                        <div class="mb-4">
                            <label for="valid_from" class="block text-primary-dark text-sm font-bold mb-2">Valid From</label>
                            <input type="datetime-local" name="valid_from" id="valid_from" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('valid_from', $coupon->valid_from->format('Y-m-d\TH:i')) }}" required>
                            @error('valid_from')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Valid Until -->
                        <div class="mb-4">
                            <label for="valid_until" class="block text-primary-dark text-sm font-bold mb-2">Valid Until</label>
                            <input type="datetime-local" name="valid_until" id="valid_until" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('valid_until', $coupon->valid_until ? $coupon->valid_until->format('Y-m-d\TH:i') : '') }}">
                            @error('valid_until')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Usage Limit -->
                        <div class="mb-4">
                            <label for="usage_limit" class="block text-primary-dark text-sm font-bold mb-2">Usage Limit</label>
                            <input type="number" name="usage_limit" id="usage_limit" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('usage_limit', $coupon->usage_limit) }}">
                            @error('usage_limit')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.coupons.index') }}" class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Update Coupon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>