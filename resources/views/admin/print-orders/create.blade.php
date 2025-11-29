<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Create Print Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <h3 class="text-lg font-medium mb-4">Create New Print Order</h3>

                    <form method="POST" action="{{ route('admin.print-orders.store') }}">
                        @csrf
                        
                        <!-- User -->
                        <div class="mb-4">
                            <label for="user_id" class="block text-primary-dark text-sm font-bold mb-2">User</label>
                            <select name="user_id" id="user_id" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
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

                        <!-- Design -->
                        <div class="mb-4">
                            <label for="design_id" class="block text-primary-dark text-sm font-bold mb-2">Design</label>
                            <select name="design_id" id="design_id" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select a Design</option>
                                @foreach($designs as $design)
                                    <option value="{{ $design->id }}" {{ old('design_id') == $design->id ? 'selected' : '' }}>
                                        {{ $design->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('design_id')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Quantity -->
                        <div class="mb-4">
                            <label for="quantity" class="block text-primary-dark text-sm font-bold mb-2">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('quantity') }}" min="1" required>
                            @error('quantity')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Paper Type -->
                        <div class="mb-4">
                            <label for="paper_type" class="block text-primary-dark text-sm font-bold mb-2">Paper Type</label>
                            <select name="paper_type" id="paper_type" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select Paper Type</option>
                                <option value="glossy" {{ old('paper_type') == 'glossy' ? 'selected' : '' }}>Glossy</option>
                                <option value="matte" {{ old('paper_type') == 'matte' ? 'selected' : '' }}>Matte</option>
                                <option value="premium" {{ old('paper_type') == 'premium' ? 'selected' : '' }}>Premium</option>
                            </select>
                            @error('paper_type')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Finish -->
                        <div class="mb-4">
                            <label for="finish" class="block text-primary-dark text-sm font-bold mb-2">Finish</label>
                            <select name="finish" id="finish" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select Finish</option>
                                <option value="none" {{ old('finish') == 'none' ? 'selected' : '' }}>None</option>
                                <option value="glossy" {{ old('finish') == 'glossy' ? 'selected' : '' }}>Glossy</option>
                                <option value="matte" {{ old('finish') == 'matte' ? 'selected' : '' }}>Matte</option>
                            </select>
                            @error('finish')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Size -->
                        <div class="mb-4">
                            <label for="size" class="block text-primary-dark text-sm font-bold mb-2">Size</label>
                            <select name="size" id="size" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select Size</option>
                                <option value="4x6" {{ old('size') == '4x6' ? 'selected' : '' }}>4x6</option>
                                <option value="5x7" {{ old('size') == '5x7' ? 'selected' : '' }}>5x7</option>
                                <option value="8x10" {{ old('size') == '8x10' ? 'selected' : '' }}>8x10</option>
                            </select>
                            @error('size')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Orientation -->
                        <div class="mb-4">
                            <label for="orientation" class="block text-primary-dark text-sm font-bold mb-2">Orientation</label>
                            <select name="orientation" id="orientation" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select Orientation</option>
                                <option value="portrait" {{ old('orientation') == 'portrait' ? 'selected' : '' }}>Portrait</option>
                                <option value="landscape" {{ old('orientation') == 'landscape' ? 'selected' : '' }}>Landscape</option>
                            </select>
                            @error('orientation')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Unit Price -->
                        <div class="mb-4">
                            <label for="unit_price" class="block text-primary-dark text-sm font-bold mb-2">Unit Price</label>
                            <input type="number" step="0.01" name="unit_price" id="unit_price" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('unit_price') }}" required>
                            @error('unit_price')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Discount -->
                        <div class="mb-4">
                            <label for="discount" class="block text-primary-dark text-sm font-bold mb-2">Discount</label>
                            <input type="number" step="0.01" name="discount" id="discount" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('discount', 0) }}">
                            @error('discount')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <label for="status" class="block text-primary-dark text-sm font-bold mb-2">Status</label>
                            <select name="status" id="status" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" required>
                                <option value="">Select Status</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="processing" {{ old('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ old('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ old('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            </select>
                            @error('status')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tracking Number -->
                        <div class="mb-4">
                            <label for="tracking_number" class="block text-primary-dark text-sm font-bold mb-2">Tracking Number</label>
                            <input type="text" name="tracking_number" id="tracking_number" class="shadow appearance-none border border-accent rounded w-full py-2 px-3 text-primary-dark leading-tight focus:outline-none focus:shadow-outline" value="{{ old('tracking_number') }}">
                            @error('tracking_number')
                                <p class="text-error-dark text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <a href="{{ route('admin.print-orders.index') }}" class="bg-secondary hover:bg-secondary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Cancel
                            </a>
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Create Print Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>