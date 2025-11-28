<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Design Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">User Design Details</h3>
                        <div>
                            <a href="{{ route('admin.user-designs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to User Designs
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-md font-semibold mb-2">Basic Information</h4>
                            <div class="border rounded p-4">
                                <div class="mb-2">
                                    <span class="font-medium">ID:</span>
                                    <span class="ml-2">{{ $design->id }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">User:</span>
                                    <span class="ml-2">{{ $design->user->name ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Template:</span>
                                    <span class="ml-2">{{ $design->template->name ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Design Name:</span>
                                    <span class="ml-2">{{ $design->design_name }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Thumbnail:</span>
                                    <span class="ml-2">{{ $design->thumbnail_path ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Completed:</span>
                                    <span class="ml-2">{{ $design->is_completed ? 'Yes' : 'No' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Status:</span>
                                    <span class="ml-2">{{ $design->status }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-md font-semibold mb-2">Statistics</h4>
                            <div class="border rounded p-4">
                                <div class="mb-2">
                                    <span class="font-medium">Downloads:</span>
                                    <span class="ml-2">{{ $design->downloads->count() }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Print Orders:</span>
                                    <span class="ml-2">{{ $design->printOrders->count() }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Shared Invitations:</span>
                                    <span class="ml-2">{{ $design->sharedInvitations->count() }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Created At:</span>
                                    <span class="ml-2">{{ $design->created_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-md font-semibold mb-2">Canvas Data</h4>
                        <div class="border rounded p-4">
                            @if($design->canvas_data)
                                <pre class="bg-gray-100 p-4 overflow-x-auto">{{ json_encode($design->canvas_data, JSON_PRETTY_PRINT) }}</pre>
                            @else
                                <p>No canvas data available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>