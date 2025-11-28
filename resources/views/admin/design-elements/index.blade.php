<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Design Elements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Design Elements</h3>
                        <a href="{{ route('admin.design-elements.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Design Element
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Premium</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($designElements as $element)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $element->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $element->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $element->type }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $element->category }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $element->is_premium ? 'Yes' : 'No' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a href="{{ route('admin.design-elements.show', $element->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                        <a href="{{ route('admin.design-elements.edit', $element->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                        <form action="{{ route('admin.design-elements.destroy', $element->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $designElements->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>