<x-guest-layout>
    <div class="mb-4">
        <h3 class="fw-bold" style="color: #1a202c;">Sign In</h3>
        <p class="text-muted small">Enter your email address and password to access your account.</p>
    </div>

    <!-- Session Status -->
    @if(session('status'))
        <div class="alert alert-success mb-4 rounded-3 text-sm">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold text-sm">Email Address</label>
            <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="name@example.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <label for="password" class="form-label fw-semibold text-sm mb-0">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-decoration-none text-sm fw-medium" href="{{ route('password.request') }}" style="color: #0b5ed7;">
                        Forgot password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" class="form-control mt-2 @error('password') is-invalid @enderror" required autocomplete="current-password" placeholder="••••••••">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-4">
            <div class="form-check">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label for="remember_me" class="form-check-label text-sm text-muted">
                    Remember me
                </label>
            </div>
        </div>

        <div>
            <button type="submit" class="btn btn-auth w-100">
                Log In
            </button>
        </div>
    </form>
</x-guest-layout>
