<nav class="bg-white border-b border-gray-200 sticky top-0 z-50 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-800 transition-colors duration-300">
                        {{ config('app.name', 'WeddingInvites') }}
                    </a>
                </div>
                <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-colors duration-300 inline-flex items-center px-1 pt-1 text-sm">
                        Home
                    </a>
                    <a href="{{ route('templates.index') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-colors duration-300 inline-flex items-center px-1 pt-1 text-sm">
                        Templates
                    </a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @auth
                    <div class="ml-3 relative">
                        <div>
                            <button class="flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <span class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-800 font-semibold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </button>
                        </div>
                    </div>
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}" class="text-gray-900 hover:text-blue-600 font-medium transition-colors duration-300 px-3 py-2 rounded-md text-sm">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 transition-colors duration-300">
                            Register
                        </a>
                    </div>
                @endauth
            </div>
            <div class="-mr-2 flex items-center sm:hidden">
                <!-- Mobile menu button -->
                <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-900 hover:text-blue-600 focus:outline-none" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100">
                Home
            </a>
            <a href="{{ route('templates.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100">
                Templates
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-900 hover:bg-blue-100">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>