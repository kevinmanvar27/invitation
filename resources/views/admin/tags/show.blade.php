<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Template Tag Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Template Tag Details</h3>
                        <div>
                            <a href="{{ route('admin.tags.edit', $templateTag->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Edit
                            </a>
                            <a href="{{ route('admin.tags.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to Tags
                            </a>
                        </div>
                    </div>

                    <div class="border rounded p-4">
                        <div class="mb-2">
                            <span class="font-medium">ID:</span>
                            <span class="ml-2">{{ $templateTag->id }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Template:</span>
                            <span class="ml-2">{{ $templateTag->template->name ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Tag Name:</span>
                            <span class="ml-2">{{ $templateTag->tag_name }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Created At:</span>
                            <span class="ml-2">{{ $templateTag->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Updated At:</span>
                            <span class="ml-2">{{ $templateTag->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>