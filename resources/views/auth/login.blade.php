@extends('layouts.home')

@section('content')
<!-- Include login-specific CSS -->
<link rel="stylesheet" href="{{ asset('css/login.css') }}">

<div class="login-container">
    <div class="login-left">
        <!-- Login Form -->
        <div class="login-form-wrapper">
            <div class="login-header">
                <div class="login-badge">
                    <span>🔐</span> Welcome Back
                </div>

                <h1 class="login-title">
                    Login to Your
                    <span class="login-title-highlight">Account</span>
                </h1>

                <p class="login-subtitle">
                    Sign in to continue to {{ config('app.name') }}
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

            <form method="POST" action="{{ route('login') }}" class="space-y-6 mt-6">
                @csrf

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
                           placeholder="••••••••" required autocomplete="current-password">
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between mt-2">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" class="h-4 w-4 text-primary-600"
                               name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="text-sm text-neutral-700">Remember me</span>
                    </label>

                    <a href="#" class="text-primary-600 text-sm hover:underline">
                        Forgot Password?
                    </a>
                </div>

                <!-- Button -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-lg w-full">
                        Sign In
                    </button>
                </div>
            </form>

            <!-- Register Link -->
            <p class="text-center text-sm text-neutral-700 mt-6">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-primary-600 font-medium hover:underline">
                    Create one now
                </a>
            </p>
        </div>
    </div>

    <div class="login-right">
       <svg width="460" height="460" viewBox="0 0 260 260" xmlns="http://www.w3.org/2000/svg">

  <!-- Soft Background -->
  <circle cx="130" cy="130" r="120" fill="#ebf6ef" opacity="0.45" />

  <!-- Main Lock Body -->
  <rect x="90" y="120" width="80" height="70" rx="12"
        fill="#fff5f5" stroke="#ff6b6b" stroke-width="3"/>

  <!-- Lock Shackle -->
  <path d="M110 120 Q130 85 150 120"
        fill="none" stroke="#ff6b6b" stroke-width="6" stroke-linecap="round" />

  <!-- Keyhole Circle -->
  <circle cx="130" cy="150" r="10" fill="#ff6b6b" />

  <!-- Keyhole Stem -->
  <rect x="127" y="150" width="6" height="18" rx="3" fill="#737373" />

  <!-- LOGIN Badge Background (animated color pulse) -->
  <circle cx="165" cy="105" r="20">
    <animate attributeName="fill"
             values="#5eaa6a; #ffc9c9; #5eaa6a"
             dur="2.6s"
             repeatCount="indefinite"/>
  </circle>

  <!-- Arrow (Login icon) -->
  <polyline points="158,105 172,105 166,99"
            fill="none" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
    <animate attributeName="opacity"
             values="1;0.5;1"
             dur="2.6s"
             repeatCount="indefinite" />
  </polyline>

  <polyline points="158,105 172,105 166,111"
            fill="none" stroke="white" stroke-width="4" stroke-linecap="round" stroke-linejoin="round">
    <animate attributeName="opacity"
             values="1;0.5;1"
             dur="2.6s"
             repeatCount="indefinite" />
  </polyline>

  <!-- Bottom Card -->
  <rect x="55" y="165" width="150" height="60" rx="14"
        fill="#fffdf6" stroke="#f2cc70" stroke-width="2" />

  <!-- Text lines -->
  <rect x="75" y="178" width="110" height="6" rx="3" fill="#a3a3a3" />
  <rect x="85" y="194" width="90" height="6" rx="3" fill="#d4d4d4" />

</svg>

    </div>
</div>
@endsection