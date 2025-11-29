<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-primary-dark leading-tight">
            {{ __('Download Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-primary-dark">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Download #{{ $download->id }}</h3>
                        <div>
                            <a href="{{ route('admin.downloads.edit', $download->id) }}" class="bg-primary hover:bg-primary-dark text-primary-dark font-bold py-2 px-4 rounded">
                                Edit
                            </a>
                            <form action="{{ route('admin.downloads.destroy', $download->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-error hover:bg-error-dark text-primary-dark font-bold py-2 px-4 rounded ml-2" onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium mb-4">Download Information</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">ID:</label>
                                    <span class="ml-2">{{ $download->id }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">User:</label>
                                    <span class="ml-2">{{ $download->user->name ?? 'N/A' }} ({{ $download->user->email ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Design:</label>
                                    <span class="ml-2">{{ $download->design->name ?? 'N/A' }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">File Type:</label>
                                    <span class="ml-2">{{ $download->file_type }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Resolution:</label>
                                    <span class="ml-2">{{ $download->resolution }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">File Size:</label>
                                    <span class="ml-2">{{ $download->file_size }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">File Path:</label>
                                    <span class="ml-2">{{ $download->file_path }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Download Count:</label>
                                    <span class="ml-2">{{ $download->download_count }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border rounded p-4">
                            <h4 class="text-md font-medium mb-4">Timestamps</h4>
                            
                            <div class="space-y-3">
                                <div>
                                    <label class="font-medium">Created At:</label>
                                    <span class="ml-2">{{ $download->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                
                                <div>
                                    <label class="font-medium">Updated At:</label>
                                    <span class="ml-2">{{ $download->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <a href="{{ route('admin.downloads.index') }}" class="text-primary hover:text-primary-dark">
                            ← Back to Downloads
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>