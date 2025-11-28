@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Wedding Invitation Templates</h1>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($templates as $template)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                            <img src="{{ asset($template->thumbnail_path) }}" alt="{{ $template->name }}" class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ $template->name }}</h2>
                                <p class="text-gray-600 mb-4">{{ $template->description }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">{{ $template->theme }} - {{ $template->style }}</span>
                                    @if ($template->is_premium)
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Premium</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">Free</span>
                                    @endif
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('templates.show', $template->id) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Use This Template
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    {{ $templates->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection