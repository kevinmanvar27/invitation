<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('RSVP Response Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">RSVP Response #{{ $rsvpResponse->id }}</h3>
                        <div>
                            <a href="{{ route('admin.rsvp-responses.edit', $rsvpResponse->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.rsvp-responses.destroy', $rsvpResponse->id) }}" method="POST" class="inline">
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
                            <h4 class="text-md font-medium mb-4">RSVP Response Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">ID:</label>
                                    <span class="ml-2">{{ $rsvpResponse->id }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Shared Invitation:</label>
                                    <span class="ml-2">{{ $rsvpResponse->sharedInvitation->id ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Guest Name:</label>
                                    <span class="ml-2">{{ $rsvpResponse->guest_name }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Guest Email:</label>
                                    <span class="ml-2">{{ $rsvpResponse->guest_email ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Guest Phone:</label>
                                    <span class="ml-2">{{ $rsvpResponse->guest_phone ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Response:</label>
                                    <span class="ml-2">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $rsvpResponse->response === 'yes' ? 'bg-green-100 text-green-800' : 
                                               ($rsvpResponse->response === 'no' ? 'bg-red-100 text-red-800' : 
                                               'bg-yellow-100 text-yellow-800') }}">
                                            {{ ucfirst($rsvpResponse->response) }}
                                        </span>
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Plus Ones Count:</label>
                                    <span class="ml-2">{{ $rsvpResponse->plus_ones_count }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Meal Preference:</label>
                                    <span class="ml-2">{{ $rsvpResponse->meal_preference ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium mb-4">Additional Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">Special Requests:</label>
                                    <span class="ml-2">{{ $rsvpResponse->special_requests ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Responded At:</label>
                                    <span class="ml-2">{{ $rsvpResponse->responded_at ? $rsvpResponse->responded_at->format('M d, Y H:i') : 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Created At:</label>
                                    <span class="ml-2">{{ $rsvpResponse->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Updated At:</label>
                                    <span class="ml-2">{{ $rsvpResponse->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.rsvp-responses.index') }}" class="text-blue-600 hover:text-blue-900">
                            ← Back to RSVP Responses
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>