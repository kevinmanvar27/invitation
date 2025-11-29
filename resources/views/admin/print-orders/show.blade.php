<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Print Order Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Print Order #{{ $printOrder->id }}</h3>
                        <div>
                            <a href="{{ route('admin.print-orders.edit', $printOrder->id) }}" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.print-orders.destroy', $printOrder->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-error hover:bg-error-dark text-primary-dark font-bold py-2 px-4 rounded ml-2" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border border-accent rounded p-4">
                            <h4 class="text-md font-medium mb-4">Order Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">ID:</label>
                                    <span class="ml-2">{{ $printOrder->id }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">User:</label>
                                    <span class="ml-2">{{ $printOrder->user->name ?? 'N/A' }} ({{ $printOrder->user->email ?? 'N/A' }})</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Design:</label>
                                    <span class="ml-2">{{ $printOrder->design->name ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Quantity:</label>
                                    <span class="ml-2">{{ $printOrder->quantity }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Paper Type:</label>
                                    <span class="ml-2">{{ $printOrder->paper_type }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Finish:</label>
                                    <span class="ml-2">{{ $printOrder->finish }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Size:</label>
                                    <span class="ml-2">{{ $printOrder->size }}</span>
                                </div>

                                <div>
                                    <label class="font-medium">Delivery Address:</label>
                                    <span class="ml-2">{{ $printOrder->delivery_address ?? 'N/A' }}</span>
                                </div>

                                <div>
                                    <label class="font-medium">Orientation:</label>
                                    <span class="ml-2">{{ $printOrder->orientation }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border border-accent rounded p-4">
                            <h4 class="text-md font-medium mb-4">Pricing & Status</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">Unit Price:</label>
                                    <span class="ml-2">${{ $printOrder->unit_price }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Total Price:</label>
                                    <span class="ml-2">${{ $printOrder->total_price }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Discount:</label>
                                    <span class="ml-2">${{ $printOrder->discount }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Status:</label>
                                    <span class="ml-2">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $printOrder->status === 'pending' ? 'bg-accent-light text-accent-dark' : 
                                               ($printOrder->status === 'processing' ? 'bg-primary-light text-primary-dark' : 
                                               ($printOrder->status === 'shipped' ? 'bg-primary-light text-primary-dark' : 
                                               ($printOrder->status === 'delivered' ? 'bg-secondary-light text-secondary-dark' : 
                                               'bg-secondary-light text-secondary-dark'))) }}">
                                            {{ ucfirst($printOrder->status) }}
                                        </span>
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Tracking Number:</label>
                                    <span class="ml-2">{{ $printOrder->tracking_number ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Ordered At:</label>
                                    <span class="ml-2">{{ $printOrder->ordered_at ? $printOrder->ordered_at->format('M d, Y H:i') : 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Created At:</label>
                                    <span class="ml-2">{{ $printOrder->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Updated At:</label>
                                    <span class="ml-2">{{ $printOrder->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.print-orders.index') }}" class="text-primary hover:text-primary-dark">
                            ← Back to Print Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>