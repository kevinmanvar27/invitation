@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">{{ $template->name }}</h1>
                    <a href="{{ route('templates.index') }}" class="text-blue-600 hover:text-blue-800">
                        &larr; Back to Templates
                    </a>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <img src="{{ asset($template->preview_path) }}" alt="{{ $template->name }}" class="w-full rounded-lg shadow-md">
                    </div>
                    
                    <div>
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-2">Description</h2>
                            <p class="text-gray-600">{{ $template->description }}</p>
                        </div>
                        
                        <div class="mb-6">
                            <h2 class="text-xl font-semibold mb-2">Details</h2>
                            <ul class="list-disc list-inside text-gray-600 space-y-1">
                                <li><strong>Theme:</strong> {{ $template->theme }}</li>
                                <li><strong>Style:</strong> {{ $template->style }}</li>
                                <li><strong>Orientation:</strong> {{ ucfirst($template->orientation) }}</li>
                                <li>
                                    <strong>Price:</strong> 
                                    @if ($template->is_premium)
                                        ${{ $template->price }}
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Premium</span>
                                    @else
                                        Free
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Free</span>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        
                        <div class="mt-8">
                            <a href="{{ route('editor.show', $template) }}" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Customize This Template
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection