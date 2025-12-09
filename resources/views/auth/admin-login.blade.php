@extends('layouts.admin-login')

@section('content')
<div class="admin-login-container">
    <div class="admin-login-left">
        <!-- Login Form -->
        <div class="admin-login-form-wrapper">
            <div class="admin-login-header">
                <div class="admin-login-badge">
                    <span>🔒</span> Admin Portal
                </div>

                <h1 class="admin-login-title">
                    Admin
                    <span class="admin-login-title-highlight">Login</span>
                </h1>

                <p class="admin-login-subtitle">
                    Sign in to access the administration panel
                </p>
            </div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="error-box mt-4">
                    <ul class="error-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}" class="mt-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-800 mb-0 mt-4">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="admin@example.com"
                           value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-800 mb-0 mt-4">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="••••••••" required autocomplete="current-password">
                </div>

                <!-- Remember + User Login -->
                <div class="flex items-center justify-between mt-2">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="h-4 w-4 text-primary-600"
                               name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="text-sm text-neutral-700">Remember me</span>
                    </label>

                    <a href="{{ route('login') }}" class="text-primary-600 text-sm hover:underline">
                        User Login
                    </a>
                </div>

                <!-- Button -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg w-full">
                        Sign In to Admin
                    </button>
                </div>
            </form>

            <!-- Back to main site -->
            <p class="text-center text-sm text-neutral-700 mt-6">
                <a href="{{ route('home') }}" class="text-primary-600 font-medium hover:underline">
                    ← Back to main site
                </a>
            </p>
        </div>
    </div>

    <div class="admin-login-right">
        <svg width="460" height="460" viewBox="0 0 260 260" xmlns="http://www.w3.org/2000/svg">
            <!-- Soft Background -->
            <circle cx="130" cy="130" r="120" fill="#f8faf9" opacity="0.45" />

            <!-- Dashboard Icon -->
            <rect x="70" y="90" width="120" height="80" rx="8"
                  fill="#fff5f5" stroke="#ff6b6b" stroke-width="2"/>

            <!-- Graph Elements -->
            <polyline points="80,140 95,130 110,135 125,120 140,125 155,110 170,115"
                      fill="none" stroke="#5eaa6a" stroke-width="3" stroke-linecap="round" />

            <!-- Stats Bars -->
            <rect x="85" y="150" width="8" height="15" rx="2" fill="#f2cc70" />
            <rect x="100" y="140" width="8" height="25" rx="2" fill="#f2cc70" />
            <rect x="115" y="145" width="8" height="20" rx="2" fill="#f2cc70" />
            <rect x="130" y="135" width="8" height="30" rx="2" fill="#f2cc70" />
            <rect x="145" y="155" width="8" height="10" rx="2" fill="#f2cc70" />
            <rect x="160" y="140" width="8" height="25" rx="2" fill="#f2cc70" />

            <!-- Shield Icon -->
            <path d="M185 100 Q195 90 205 100 Q210 110 205 120 Q195 130 185 120 Q180 110 185 100"
                  fill="#5eaa6a" stroke="#3a7244" stroke-width="1" />

            <!-- ADMIN Badge Background -->
            <circle cx="195" cy="110" r="15" fill="#ff6b6b">
                <animate attributeName="fill"
                         values="#ff6b6b; #ffc9c9; #ff6b6b"
                         dur="2.6s"
                         repeatCount="indefinite"/>
            </circle>

            <!-- Letter A -->
            <text x="195" y="115" font-family="Arial, sans-serif" font-size="16" font-weight="bold"
                  text-anchor="middle" fill="white">A</text>

            <!-- Security Lock -->
            <rect x="110" y="60" width="40" height="30" rx="5"
                  fill="#8f5f3e" stroke="#543323" stroke-width="1"/>
            <circle cx="130" cy="70" r="5" fill="#f8faf9" />

            <!-- Connection Lines -->
            <line x1="130" y1="90" x2="130" y2="110" stroke="#a3a3a3" stroke-width="2" stroke-dasharray="4,2"/>
            <line x1="130" y1="110" x2="195" y2="110" stroke="#a3a3a3" stroke-width="2" stroke-dasharray="4,2"/>
        </svg>
    </div>
</div>

@endsection