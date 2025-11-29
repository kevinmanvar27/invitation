<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Subscription Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Subscription #{{ $subscription->id }}</h3>
                        <div>
                            <a href="{{ route('admin.subscriptions.edit', $subscription->id) }}" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.subscriptions.destroy', $subscription->id) }}" method="POST" class="inline">
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
                                    <span class="ml-2">{{ $subscription->user->name ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Email:</span>
                                    <span class="ml-2">{{ $subscription->user->email ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="border rounded-lg p-4">
                            <h4 class="text-md font-semibold mb-3">Subscription Details</h4>
                            <div class="space-y-2">
                                <div>
                                    <span class="font-medium">Plan Type:</span>
                                    <span class="ml-2">{{ ucfirst($subscription->plan_type) }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Price:</span>
                                    <span class="ml-2">${{ $subscription->price }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Currency:</span>
                                    <span class="ml-2">{{ $subscription->currency }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Status:</span>
                                    <span class="ml-2">
                                        @if($subscription->status === 'active')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success-light text-primary-dark">Active</span>
                                        @elseif($subscription->status === 'inactive')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-warning-light text-primary-dark">Inactive</span>
                                        @elseif($subscription->status === 'expired')
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-error-light text-primary-dark">Expired</span>
                                        @endif
                                    </span>
                                </div>
                                <div>
                                    <span class="font-medium">Started At:</span>
                                    <span class="ml-2">{{ $subscription->started_at->format('M d, Y') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Expires At:</span>
                                    <span class="ml-2">{{ $subscription->expires_at->format('M d, Y') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Created At:</span>
                                    <span class="ml-2">{{ $subscription->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Updated At:</span>
                                    <span class="ml-2">{{ $subscription->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('admin.subscriptions.index') }}" class="text-primary-dark hover:text-primary text-primary-dark font-bold py-2 px-4 rounded">
                            ← Back to Subscriptions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>