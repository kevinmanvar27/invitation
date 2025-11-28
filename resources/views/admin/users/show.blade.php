<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">User Details</h3>
                        <div>
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Edit
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Back to Users
                            </a>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h4 class="text-md font-semibold mb-2">Basic Information</h4>
                            <div class="border rounded p-4">
                                <div class="mb-2">
                                    <span class="font-medium">ID:</span>
                                    <span class="ml-2">{{ $user->id }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Name:</span>
                                    <span class="ml-2">{{ $user->name }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Email:</span>
                                    <span class="ml-2">{{ $user->email }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Email Verified At:</span>
                                    <span class="ml-2">{{ $user->email_verified_at ? $user->email_verified_at->format('M d, Y H:i') : 'Not verified' }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="font-medium">Created At:</span>
                                    <span class="ml-2">{{ $user->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="font-medium">Updated At:</span>
                                    <span class="ml-2">{{ $user->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-md font-semibold mb-2">Profile Information</h4>
                            <div class="border rounded p-4">
                                @if($user->profile)
                                    <div class="mb-2">
                                        <span class="font-medium">Wedding Date:</span>
                                        <span class="ml-2">{{ $user->profile->wedding_date ?? 'N/A' }}</span>
                                    </div>
                                    <div class="mb-2">
                                        <span class="font-medium">Partner Name:</span>
                                        <span class="ml-2">{{ $user->profile->partner_name ?? 'N/A' }}</span>
                                    </div>
                                @else
                                    <p>No profile information available.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h4 class="text-md font-semibold mb-2">Statistics</h4>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="border rounded p-4 text-center">
                                <div class="text-2xl font-bold">{{ $user->designs->count() }}</div>
                                <div class="text-gray-600">Designs</div>
                            </div>
                            <div class="border rounded p-4 text-center">
                                <div class="text-2xl font-bold">{{ $user->subscriptions->count() }}</div>
                                <div class="text-gray-600">Subscriptions</div>
                            </div>
                            <div class="border rounded p-4 text-center">
                                <div class="text-2xl font-bold">{{ $user->payments->count() }}</div>
                                <div class="text-gray-600">Payments</div>
                            </div>
                            <div class="border rounded p-4 text-center">
                                <div class="text-2xl font-bold">{{ $user->sharedInvitations->count() }}</div>
                                <div class="text-gray-600">Shared Invitations</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>