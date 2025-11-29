<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Shipping Address Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Shipping Address #{{ $shippingAddress->id }}</h3>
                        <div>
                            <a href="{{ route('admin.shipping-addresses.edit', $shippingAddress->id) }}" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.shipping-addresses.destroy', $shippingAddress->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-error hover:bg-error-dark text-primary-dark font-bold py-2 px-4 rounded ml-2" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border rounded-lg p-4">
                            <h4 class="text-md font-semibold mb-3">User Information</h4>
                            <div class="space-y-2">
                                <div>
                                    <span class="font-medium">User:</span>
                                    <span class="ml-2">{{ $shippingAddress->user->name ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Email:</span>
                                    <span class="ml-2">{{ $shippingAddress->user->email ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="border rounded-lg p-4">
                            <h4 class="text-md font-semibold mb-3">Address Details</h4>
                            <div class="space-y-2">
                                <div>
                                    <span class="font-medium">Full Name:</span>
                                    <span class="ml-2">{{ $shippingAddress->full_name }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Phone:</span>
                                    <span class="ml-2">{{ $shippingAddress->phone ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Address:</span>
                                    <span class="ml-2">{{ $shippingAddress->address_line1 }}</span>
                                </div>
                                @if($shippingAddress->address_line2)
                                <div>
                                    <span class="font-medium">Address Line 2:</span>
                                    <span class="ml-2">{{ $shippingAddress->address_line2 }}</span>
                                </div>
                                @endif
                                <div>
                                    <span class="font-medium">City:</span>
                                    <span class="ml-2">{{ $shippingAddress->city }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">State:</span>
                                    <span class="ml-2">{{ $shippingAddress->state }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Postal Code:</span>
                                    <span class="ml-2">{{ $shippingAddress->postal_code }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Country:</span>
                                    <span class="ml-2">{{ $shippingAddress->country }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Default Address:</span>
                                    <span class="ml-2">
                                        @if($shippingAddress->is_default)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success-light text-primary-dark">Yes</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-secondary-light text-primary-dark">No</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('admin.shipping-addresses.index') }}" class="text-primary-dark hover:text-primary text-primary-dark font-bold py-2 px-4 rounded">
                            ← Back to Shipping Addresses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>