<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Customization Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">User Customization Details</h3>
                        <div>
                            <a href="{{ route('admin.user-customizations.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to User Customizations
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-md font-semibold mb-2">Basic Information</h4>
                            <div class="border rounded p-4">
                                <div class="mb-2">
                                    <span class="font-medium">ID:</span>
                                    <span class="ml-2">{{ $customization->id }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Design:</span>
                                    <span class="ml-2">{{ $customization->design->design_name ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">User:</span>
                                    <span class="ml-2">{{ $customization->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Bride Name:</span>
                                    <span class="ml-2">{{ $customization->bride_name }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Groom Name:</span>
                                    <span class="ml-2">{{ $customization->groom_name }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Wedding Date:</span>
                                    <span class="ml-2">{{ $customization->wedding_date ? $customization->wedding_date->format('M d, Y') : 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Wedding Time:</span>
                                    <span class="ml-2">{{ $customization->wedding_time ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Venue:</span>
                                    <span class="ml-2">{{ $customization->venue ?? 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Language:</span>
                                    <span class="ml-2">{{ $customization->language ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-md font-semibold mb-2">Additional Information</h4>
                            <div class="border rounded p-4">
                                <div class="mb-2">
                                    <span class="font-medium">Wording Style:</span>
                                    <span class="ml-2">{{ $customization->wording_style ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">RSVP Enabled:</span>
                                    <span class="ml-2">{{ $customization->rsvp_enabled ? 'Yes' : 'No' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">RSVP Deadline:</span>
                                    <span class="ml-2">{{ $customization->rsvp_deadline ? $customization->rsvp_deadline->format('M d, Y') : 'N/A' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Created At:</span>
                                    <span class="ml-2">{{ $customization->created_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>

                            <h4 class="text-md font-semibold mb-2 mt-4">Custom Text</h4>
                            <div class="border rounded p-4">
                                @if($customization->custom_text)
                                    @if(is_array($customization->custom_text))
                                        <ul class="list-disc pl-5">
                                            @foreach($customization->custom_text as $key => $text)
                                                <li><span class="font-medium">{{ $key }}:</span> {{ $text }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>{{ $customization->custom_text }}</p>
                                    @endif
                                @else
                                    <p>No custom text available.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>