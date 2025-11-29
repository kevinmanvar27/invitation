<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('RSVP Setting Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium text-primary-dark">RSVP Setting #{{ $rsvpSetting->id }}</h3>
                        <div>
                            <a href="{{ route('admin.rsvp-settings.edit', $rsvpSetting->id) }}" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.rsvp-settings.destroy', $rsvpSetting->id) }}" method="POST" class="inline">
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
                            <h4 class="text-md font-medium text-primary-dark mb-4">RSVP Setting Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">ID:</label>
                                    <span class="ml-2">{{ $rsvpSetting->id }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Setting Name:</label>
                                    <span class="ml-2">{{ $rsvpSetting->setting_name ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Setting Value:</label>
                                    <span class="ml-2">{{ $rsvpSetting->setting_value ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Description:</label>
                                    <span class="ml-2">{{ $rsvpSetting->description ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Design:</label>
                                    <span class="ml-2">{{ $rsvpSetting->design->design_name ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">User:</label>
                                    <span class="ml-2">{{ $rsvpSetting->user->name ?? 'N/A' }} ({{ $rsvpSetting->user->email ?? 'N/A' }})</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">RSVP Enabled:</label>
                                    <span class="ml-2">
                                        @if($rsvpSetting->rsvp_enabled)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-secondary-light text-secondary-dark">Enabled</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-error-light text-error-dark">Disabled</span>
                                        @endif
                                    </span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Deadline:</label>
                                    <span class="ml-2">{{ $rsvpSetting->deadline ? $rsvpSetting->deadline->format('M d, Y') : 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Max Guests Per Invite:</label>
                                    <span class="ml-2">{{ $rsvpSetting->max_guests_per_invite }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Collect Meal Preferences:</label>
                                    <span class="ml-2">
                                        @if($rsvpSetting->collect_meal_preferences)
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-secondary-light text-secondary-dark">Yes</span>
                                        @else
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-error-light text-error-dark">No</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium text-primary-dark mb-4">Custom Questions</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">Custom Questions:</label>
                                    <div class="ml-2">
                                        @if($rsvpSetting->custom_questions)
                                            <pre class="bg-secondary-light p-2 rounded">{{ json_encode($rsvpSetting->custom_questions, JSON_PRETTY_PRINT) }}</pre>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Created At:</label>
                                    <span class="ml-2">{{ $rsvpSetting->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Updated At:</label>
                                    <span class="ml-2">{{ $rsvpSetting->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.rsvp-settings.index') }}" class="text-primary hover:text-primary-dark">
                            ← Back to RSVP Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>