<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Design Element Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Design Element Details</h3>
                        <div>
                            <a href="{{ route('admin.elements.edit', $designElement->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Edit
                            </a>
                            <a href="{{ route('admin.elements.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to List
                            </a>
                        </div>
                    </div>

                    <div class="border rounded p-4">
                        <div class="mb-4">
                            <span class="font-medium">ID:</span>
                            <span class="ml-2">{{ $designElement->id }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="font-medium">Name:</span>
                            <span class="ml-2">{{ $designElement->name }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="font-medium">Type:</span>
                            <span class="ml-2">{{ $designElement->type }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="font-medium">Category:</span>
                            <span class="ml-2">{{ $designElement->category }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="font-medium">Preview Image:</span>
                            @if($designElement->file_path)
                                <img src="{{ asset($designElement->file_path) }}" alt="{{ $designElement->name }}" class="mt-2 max-w-xs">
                            @else
                                <span class="ml-2">No image available</span>
                            @endif
                        </div>
                        <div class="mb-4">
                            <span class="font-medium">Status:</span>
                            <span class="ml-2">{{ $designElement->is_active ? 'Active' : 'Inactive' }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="font-medium">Created At:</span>
                            <span class="ml-2">{{ $designElement->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Updated At:</span>
                            <span class="ml-2">{{ $designElement->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>