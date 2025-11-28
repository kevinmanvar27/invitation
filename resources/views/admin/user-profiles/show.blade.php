<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Profile Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">User Profile #{{ $userProfile->id }}</h3>
                        <div>
                            <a href="{{ route('admin.user-profiles.edit', $userProfile->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.user-profiles.destroy', $userProfile->id) }}" method="POST" class="inline">
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
                            <h4 class="text-md font-medium mb-4">Profile Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">ID:</label>
                                    <span class="ml-2">{{ $userProfile->id }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">User:</label>
                                    <span class="ml-2">{{ $userProfile->user->name ?? 'N/A' }} ({{ $userProfile->user->email ?? 'N/A' }})</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Partner Name:</label>
                                    <span class="ml-2">{{ $userProfile->partner_name ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Wedding Date:</label>
                                    <span class="ml-2">{{ $userProfile->wedding_date ? $userProfile->wedding_date->format('M d, Y') : 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Profile Picture:</label>
                                    <div class="ml-2">
                                        @if($userProfile->profile_picture)
                                            <img src="{{ asset($userProfile->profile_picture) }}" alt="Profile Picture" class="w-32 h-32 object-cover rounded">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium mb-4">Preferences</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">Preferences:</label>
                                    <div class="ml-2">
                                        @if($userProfile->preferences)
                                            <div class="bg-gray-100 p-2 rounded">
                                                @foreach($userProfile->preferences as $key => $value)
                                                    <div><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ is_array($value) ? json_encode($value) : $value }}</div>
                                                @endforeach
                                            </div>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Created At:</label>
                                    <span class="ml-2">{{ $userProfile->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Updated At:</label>
                                    <span class="ml-2">{{ $userProfile->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.user-profiles.index') }}" class="text-blue-600 hover:text-blue-900">
                            ← Back to User Profiles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>