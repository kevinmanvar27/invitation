<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Template Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Template Details</h3>
                        <div>
                            <a href="{{ route('admin.templates.edit', $template->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Edit
                            </a>
                            <a href="{{ route('admin.templates.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to Templates
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-md font-semibold mb-2">Basic Information</h4>
                            <div class="border rounded p-4">
                                <div class="mb-2">
                                    <span class="font-medium">ID:</span>
                                    <span class="ml-2">{{ $template->id }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Name:</span>
                                    <span class="ml-2">{{ $template->name }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Slug:</span>
                                    <span class="ml-2">{{ $template->slug }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Category:</span>
                                    <span class="ml-2">{{ $template->category->name ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Theme:</span>
                                    <span class="ml-2">{{ $template->theme ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Style:</span>
                                    <span class="ml-2">{{ $template->style ?? 'N/A' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Orientation:</span>
                                    <span class="ml-2">{{ $template->orientation }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Premium:</span>
                                    <span class="ml-2">{{ $template->is_premium ? 'Yes' : 'No' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Price:</span>
                                    <span class="ml-2">
                                                                            @if($template->is_premium && !is_null($template->price))
                                                                                ₹{{ $template->price }}
                                                                            @elseif($template->is_premium)
                                                                                ₹0.00
                                                                            @else
                                                                                Free
                                                                            @endif
                                                                        </span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Active:</span>
                                    <span class="ml-2">{{ $template->is_active ? 'Yes' : 'No' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Created At:</span>
                                    <span class="ml-2">{{ $template->created_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-md font-semibold mb-2">Description</h4>
                            <div class="border rounded p-4">
                                <p>{{ $template->description ?? 'No description provided.' }}</p>
                            </div>

                            <h4 class="text-md font-semibold mb-2 mt-4">Statistics</h4>
                            <div class="border rounded p-4">
                                <div class="mb-2">
                                    <span class="font-medium">Downloads Count:</span>
                                    <span class="ml-2">{{ $template->downloads_count }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Usage Count:</span>
                                    <span class="ml-2">{{ $template->usage_count }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>