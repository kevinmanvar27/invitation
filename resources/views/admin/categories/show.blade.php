<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Template Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium mb-4">Template Category Details</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border rounded-lg p-4">
                            <h4 class="text-md font-semibold mb-3">Category Information</h4>
                            <div class="space-y-2">
                                <div>
                                    <span class="font-medium">ID:</span>
                                    <span class="ml-2">{{ $category->id }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Name:</span>
                                    <span class="ml-2">{{ $category->name }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Slug:</span>
                                    <span class="ml-2">{{ $category->slug }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Parent Category:</span>
                                    <span class="ml-2">{{ $category->parent ? $category->parent->name : 'None' }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Order:</span>
                                    <span class="ml-2">{{ $category->order }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Icon:</span>
                                    <span class="ml-2">{{ $category->icon ?? 'None' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="border rounded-lg p-4">
                            <h4 class="text-md font-semibold mb-3">Description</h4>
                            <p>{{ $category->description ?? 'No description provided.' }}</p>
                        </div>
                    </div>

                    <div class="mt-6 border rounded-lg p-4">
                        <h4 class="text-md font-semibold mb-3">Child Categories ({{ $category->children->count() }})</h4>
                        @if($category->children->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($category->children as $child)
                                    <div class="border rounded p-3">
                                        <div class="font-medium">{{ $child->name }}</div>
                                        <div class="text-sm text-gray-600">{{ $child->templates_count }} templates</div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No child categories.</p>
                        @endif
                    </div>

                    <div class="mt-6 border rounded-lg p-4">
                        <h4 class="text-md font-semibold mb-3">Templates ({{ $category->templates->count() }})</h4>
                        @if($category->templates->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($category->templates as $template)
                                    <div class="border rounded p-3">
                                        <div class="font-medium">{{ $template->name }}</div>
                                        <div class="text-sm text-gray-600">${{ $template->price }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No templates in this category.</p>
                        @endif
                    </div>

                    <div class="mt-6 flex items-center justify-between">
                        <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Categories
                        </a>
                        <div class="space-x-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure you want to delete this category?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>