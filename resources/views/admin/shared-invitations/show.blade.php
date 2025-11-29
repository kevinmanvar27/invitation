<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Shared Invitation Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-primary-dark">Shared Invitation #{{ $sharedInvitation->id }}</h3>
                        <div>
                            <a href="{{ route('admin.shared-invitations.edit', $sharedInvitation->id) }}" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.shared-invitations.destroy', $sharedInvitation->id) }}" method="POST" class="inline">
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
                            <h4 class="text-md font-medium text-primary-dark mb-4">Shared Invitation Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">ID:</label>
                                    <span class="ml-2">{{ $sharedInvitation->id }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Design:</label>
                                    <span class="ml-2">{{ $sharedInvitation->design->name ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">User:</label>
                                    <span class="ml-2">{{ $sharedInvitation->user->name ?? 'N/A' }} ({{ $sharedInvitation->user->email ?? 'N/A' }})</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Share Token:</label>
                                    <span class="ml-2">{{ $sharedInvitation->share_token }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Share Method:</label>
                                    <span class="ml-2">{{ ucfirst($sharedInvitation->share_method) }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Recipient Email:</label>
                                    <span class="ml-2">{{ $sharedInvitation->recipient_email ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Recipient Phone:</label>
                                    <span class="ml-2">{{ $sharedInvitation->recipient_phone ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">View Count:</label>
                                    <span class="ml-2">{{ $sharedInvitation->view_count }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium text-primary-dark mb-4">Timestamps</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">Sent At:</label>
                                    <span class="ml-2">{{ $sharedInvitation->sent_at ? $sharedInvitation->sent_at->format('M d, Y H:i') : 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Viewed At:</label>
                                    <span class="ml-2">{{ $sharedInvitation->viewed_at ? $sharedInvitation->viewed_at->format('M d, Y H:i') : 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Created At:</label>
                                    <span class="ml-2">{{ $sharedInvitation->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Updated At:</label>
                                    <span class="ml-2">{{ $sharedInvitation->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.shared-invitations.index') }}" class="text-primary hover:text-primary-dark">
                            ← Back to Shared Invitations
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>