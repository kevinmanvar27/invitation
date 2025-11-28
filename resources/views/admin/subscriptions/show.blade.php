<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subscription Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Subscription #{{ $subscription->id }}</h3>
                        <div>
                            <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="POST" class="inline">
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
                            <h4 class="text-md font-medium mb-4">Subscription Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">ID:</label>
                                    <span class="ml-2">{{ $subscription->id }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">User:</label>
                                    <span class="ml-2">{{ $subscription->user->name ?? 'N/A' }} ({{ $subscription->user->email ?? 'N/A' }})</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Plan Type:</label>
                                    <span class="ml-2">{{ $subscription->plan_type }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Price:</label>
                                    <span class="ml-2">{{ $subscription->price }} {{ $subscription->currency }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Status:</label>
                                    <span class="ml-2">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $subscription->status === 'active' ? 'bg-green-100 text-green-800' : 
                                               ($subscription->status === 'expired' ? 'bg-red-100 text-red-800' : 
                                               'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($subscription->status) }}
                                        </span>
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Started At:</label>
                                    <span class="ml-2">{{ $subscription->started_at ? $subscription->started_at->format('M d, Y H:i') : 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Expires At:</label>
                                    <span class="ml-2">{{ $subscription->expires_at ? $subscription->expires_at->format('M d, Y H:i') : 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Payment ID:</label>
                                    <span class="ml-2">{{ $subscription->payment_id ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium mb-4">Timestamps</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">Created At:</label>
                                    <span class="ml-2">{{ $subscription->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Updated At:</label>
                                    <span class="ml-2">{{ $subscription->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.subscriptions.index') }}" class="text-blue-600 hover:text-blue-900">
                            ← Back to Subscriptions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>