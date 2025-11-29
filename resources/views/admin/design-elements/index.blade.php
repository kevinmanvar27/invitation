<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Manage Design Elements') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Design Elements</h3>
                        <a href="{{ route('admin.design-elements.create') }}" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                            Add Design Element
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-secondary-light">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Type</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Category</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Premium</th>
                                    <th class="px-6 py-3 bg-secondary-light text-left text-xs leading-4 font-medium text-secondary-dark uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-secondary-light">
                                @foreach($designElements as $element)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap text-primary-dark">{{ $element->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-primary-dark">{{ $element->name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-primary-dark">{{ $element->type }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-primary-dark">{{ $element->category }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap text-primary-dark">{{ $element->is_premium ? 'Yes' : 'No' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a href="{{ route('admin.design-elements.show', $element->id) }}" class="text-primary hover:text-primary-dark mr-3">View</a>
                                        <a href="{{ route('admin.design-elements.edit', $element->id) }}" class="text-secondary hover:text-secondary-dark mr-3">Edit</a>
                                        <form action="{{ route('admin.design-elements.destroy', $element->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-error hover:text-error-dark" onclick="return confirm('Are you sure?')">Delete</button>
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