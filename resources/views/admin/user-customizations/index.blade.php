<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage User Customizations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">User Customizations</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Design</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Bride Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Groom Name</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Wedding Date</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">RSVP Enabled</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($customizations as $customization)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $customization->id }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $customization->design->design_name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $customization->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $customization->bride_name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $customization->groom_name }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $customization->wedding_date ? $customization->wedding_date->format('M d, Y') : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">{{ $customization->rsvp_enabled ? 'Yes' : 'No' }}</td>
                                    <td class="px-6 py-4 whitespace-no-wrap">
                                        <a href="{{ route('admin.user-customizations.show', $customization->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                                        <form action="{{ route('admin.user-customizations.destroy', $customization->id) }}" method="POST" class="inline">
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
                        {{ $customizations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>