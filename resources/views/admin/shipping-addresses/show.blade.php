<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shipping Address Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Shipping Address #{{ $shippingAddress->id }}</h3>
                        <div>
                            <a href="{{ route('admin.shipping-addresses.edit', $shippingAddress->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.shipping-addresses.destroy', $shippingAddress->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium mb-4">Address Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">ID:</label>
                                    <span class="ml-2">{{ $shippingAddress->id }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">User:</label>
                                    <span class="ml-2">{{ $shippingAddress->user->name ?? 'N/A' }} ({{ $shippingAddress->user->email ?? 'N/A' }})</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Full Name:</label>
                                    <span class="ml-2">{{ $shippingAddress->full_name }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Phone:</label>
                                    <span class="ml-2">{{ $shippingAddress->phone }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Address Line 1:</label>
                                    <span class="ml-2">{{ $shippingAddress->address_line1 }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Address Line 2:</label>
                                    <span class="ml-2">{{ $shippingAddress->address_line2 ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">City:</label>
                                    <span class="ml-2">{{ $shippingAddress->city }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">State:</label>
                                    <span class="ml-2">{{ $shippingAddress->state }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium mb-4">Location & Status</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">Postal Code:</label>
                                    <span class="ml-2">{{ $shippingAddress->postal_code }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Country:</label>
                                    <span class="ml-2">{{ $shippingAddress->country }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Default Address:</label>
                                    <span class="ml-2">
                                        @if($shippingAddress->is_default)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Yes</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">No</span>
                                        @endif
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Created At:</label>
                                    <span class="ml-2">{{ $shippingAddress->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Updated At:</label>
                                    <span class="ml-2">{{ $shippingAddress->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.shipping-addresses.index') }}" class="text-blue-600 hover:text-blue-900">
                            ← Back to Shipping Addresses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>