<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Font Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Font Details</h3>
                        <div>
                            <a href="{{ route('admin.fonts.edit', $font->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Edit
                            </a>
                            <a href="{{ route('admin.fonts.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to Fonts
                            </a>
                        </div>
                    </div>

                    <div class="border rounded p-4">
                        <div class="mb-2">
                            <span class="font-medium">ID:</span>
                            <span class="ml-2">{{ $font->id }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Font Name:</span>
                            <span class="ml-2">{{ $font->font_name }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Font Family:</span>
                            <span class="ml-2">{{ $font->font_family }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Font File Path:</span>
                            <span class="ml-2">{{ $font->font_file_path ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Font Weight:</span>
                            <span class="ml-2">{{ $font->font_weight ?? 'N/A' }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Premium:</span>
                            <span class="ml-2">{{ $font->is_premium ? 'Yes' : 'No' }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Language Support:</span>
                            <span class="ml-2">{{ is_array($font->language_support) ? implode(', ', $font->language_support) : ($font->language_support ?? 'N/A') }}</span>
                        </div>
                        <div class="mb-2">
                            <span class="font-medium">Created At:</span>
                            <span class="ml-2">{{ $font->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Updated At:</span>
                            <span class="ml-2">{{ $font->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>