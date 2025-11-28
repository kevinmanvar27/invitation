<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Referral Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Referral #{{ $referral->id }}</h3>
                        <div>
                            <a href="{{ route('admin.referrals.edit', $referral->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.referrals.destroy', $referral->id) }}" method="POST" class="inline">
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
                            <h4 class="text-md font-medium mb-4">Referral Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">ID:</label>
                                    <span class="ml-2">{{ $referral->id }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Referrer User:</label>
                                    <span class="ml-2">{{ $referral->referrer->name ?? 'N/A' }} ({{ $referral->referrer->email ?? 'N/A' }})</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Referred User:</label>
                                    <span class="ml-2">{{ $referral->referred->name ?? 'N/A' }} ({{ $referral->referred->email ?? 'N/A' }})</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Reward Earned:</label>
                                    <span class="ml-2">${{ $referral->reward_earned }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium mb-4">Status & Timestamps</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">Status:</label>
                                    <span class="ml-2">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $referral->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($referral->status) }}
                                        </span>
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Created At:</label>
                                    <span class="ml-2">{{ $referral->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Updated At:</label>
                                    <span class="ml-2">{{ $referral->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.referrals.index') }}" class="text-blue-600 hover:text-blue-900">
                            ← Back to Referrals
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>