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
                            <a href="{{ route('admin.design-elements.edit', $designElement->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Edit
                            </a>
                            <a href="{{ route('admin.design-elements.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to Design Elements
                            </a>
                        </div>
                    </div>

                    <div class="border rounded p-4">
                        <div class="mb-2">
                            <span class="font-medium">ID:</span>
                            <span class="ml-2">{{ $designElement->id }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Name:</span>
                            <span class="ml-2">{{ $designElement->name }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Type:</span>
                            <span class="ml-2">{{ $designElement->type }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Category:</span>
                            <span class="ml-2">{{ $designElement->category }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">SVG Path:</span>
                            <span class="ml-2">{{ $designElement->svg_path ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">PNG Path:</span>
                            <span class="ml-2">{{ $designElement->png_path ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Premium:</span>
                            <span class="ml-2">{{ $designElement->is_premium ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Tags:</span>
                            <span class="ml-2">{{ is_array($designElement->tags) ? implode(', ', $designElement->tags) : ($designElement->tags ?? 'N/A') }}</span>
                        </div>
                        <div class="mb-2">
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