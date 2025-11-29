<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Coupon Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Coupon #{{ $coupon->id }}</h3>
                        <div>
                            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-error hover:bg-error-dark text-primary-dark font-bold py-2 px-4 rounded ml-2" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium mb-4">Coupon Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">ID:</label>
                                    <span class="ml-2">{{ $coupon->id }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Code:</label>
                                    <span class="ml-2">{{ $coupon->code }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Discount Type:</label>
                                    <span class="ml-2">{{ ucfirst($coupon->discount_type) }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Discount Value:</label>
                                    <span class="ml-2">
                                        @if($coupon->discount_type === 'percentage')
                                            {{ $coupon->discount_value }}%
                                        @else
                                            ${{ $coupon->discount_value }}
                                        @endif
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Minimum Purchase:</label>
                                    <span class="ml-2">${{ $coupon->min_purchase ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium mb-4">Validity & Usage</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">Valid From:</label>
                                    <span class="ml-2">{{ $coupon->valid_from->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Valid Until:</label>
                                    <span class="ml-2">{{ $coupon->valid_until ? $coupon->valid_until->format('M d, Y H:i') : 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Usage Limit:</label>
                                    <span class="ml-2">{{ $coupon->usage_limit ?? 'Unlimited' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Created At:</label>
                                    <span class="ml-2">{{ $coupon->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Updated At:</label>
                                    <span class="ml-2">{{ $coupon->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.coupons.index') }}" class="text-primary-dark hover:text-primary">
                            ← Back to Coupons
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>