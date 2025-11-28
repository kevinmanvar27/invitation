<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Profile Information</h3>
                        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Dashboard
                        </a>
                    </div>

                    <div class="border rounded p-4">
                        <div class="mb-4">
                            <span class="font-medium">Name:</span>
                            <span class="ml-2">{{ $admin->name }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="font-medium">Email:</span>
                            <span class="ml-2">{{ $admin->email }}</span>
                        </div>
                        <div class="mb-4">
                            <span class="font-medium">Account Created:</span>
                            <span class="ml-2">{{ $admin->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div>
                            <span class="font-medium">Last Updated:</span>
                            <span class="ml-2">{{ $admin->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>