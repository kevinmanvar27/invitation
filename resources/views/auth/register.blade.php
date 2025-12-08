@extends('layouts.home')

@section('content')
<!-- Include login-specific CSS -->
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="login-container">
    <div class="login-left">
        <!-- Registration Form -->
        <div class="login-form-wrapper">
            <div class="login-header">
                <div class="login-badge">
                    <span>🔐</span> Create Account
                </div>

                <h1 class="login-title">
                    Register your
                    <span class="login-title-highlight">Account</span>
                </h1>

                <p class="login-subtitle">
                    Join {{ config('app.name') }} to create beautiful wedding invitations
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

            <form method="POST" action="{{ route('register') }}" class="space-y-6 mt-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-neutral-800 mb-0 mt-4">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control"
                           placeholder="Your full name"
                           value="{{ old('name') }}" required autocomplete="name" autofocus>
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-neutral-800 mb-0 mt-4">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="you@example.com"
                           value="{{ old('email') }}" required autocomplete="email">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-neutral-800 mb-0 mt-4">Password</label>
                    <input type="password" id="password" name="password" class="form-control"
                           placeholder="••••••••" required autocomplete="new-password">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-neutral-800 mb-0 mt-4">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                           placeholder="••••••••" required autocomplete="new-password">
                </div>

                <!-- Button -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg w-full">
                        Create Account
                    </button>
                </div>
            </form>

            <!-- Login Link -->
            <p class="text-center text-sm text-neutral-700 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-primary-600 font-medium hover:underline">
                    Sign in
                </a>
            </p>
        </div>
    </div>

    <div class="login-right">
       <svg width="460" height="460" viewBox="0 0 260 260" xmlns="http://www.w3.org/2000/svg">

  <!-- Soft Background Circle -->
  <circle cx="130" cy="130" r="120" fill="#ffe3e3" opacity="0.45" />

  <!-- Outline Circle -->
  <circle cx="130" cy="90" r="40" 
          fill="#fff5f5" 
          stroke="#ff6b6b" 
          stroke-width="4" />

  <!-- Head -->
  <circle cx="130" cy="78" r="14" fill="#ff6b6b" />

  <!-- Body -->
  <path d="M95 120 Q130 150 165 120" 
        fill="none" 
        stroke="#737373" 
        stroke-width="4" 
        stroke-linecap="round" />

  <!-- Badge Background (Animated: Green → Blue → Green) -->
  <circle cx="165" cy="115" r="20">
    <animate attributeName="fill"
             values="#22c55e; #3B82F6; #22c55e"
             dur="2.4s"
             repeatCount="indefinite"/>
  </circle>

  <!-- PLUS ICON (shows only in green phase) -->
  <line x1="153" y1="115" x2="177" y2="115"
        stroke="white" stroke-width="4" stroke-linecap="round">
    <animate attributeName="opacity"
             values="1;0;1"
             dur="2.4s"
             repeatCount="indefinite" />
  </line>

  <line x1="165" y1="103" x2="165" y2="127"
        stroke="white" stroke-width="4" stroke-linecap="round">
    <animate attributeName="opacity"
             values="1;0;1"
             dur="2.4s"
             repeatCount="indefinite" />
  </line>

  <!-- TICK ICON (white, appears only in blue phase) -->
  <polyline points="155,115 162,123 176,108"
            fill="none"
            stroke="white"
            stroke-width="4"
            stroke-linecap="round"
            stroke-linejoin="round"
            opacity="0">
    <animate attributeName="opacity"
             values="0;1;0"
             dur="2.4s"
             repeatCount="indefinite" />
  </polyline>

  <!-- Bottom Card -->
  <rect x="55" y="160" width="150" height="70" rx="14" 
        fill="#fffdf6" 
        stroke="#f2cc70" 
        stroke-width="2" />

  <!-- Text lines -->
  <rect x="75" y="178" width="110" height="6" rx="3" fill="#a3a3a3" />
  <rect x="85" y="195" width="90" height="6" rx="3" fill="#d4d4d4" />

</svg>

    </div>
</div>
@endsection