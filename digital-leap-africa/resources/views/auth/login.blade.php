<x-guest-layout>
    <style>
        /* * NOTE: These variables are assumed to be defined in your global CSS or template.
         * If they are not, you must replace them with their hex values:
         * --charcoal: #252A32
         * --cyan-accent: #00C9FF
         * --cool-gray: #AEB8C2
         * --radius: 12px (or your preferred border radius)
         */
        
        /* Custom styling for the prominent login box */
        .login-card {
            max-width: 420px;
            width: 90%;
            margin: 4rem auto; /* Centers and adds vertical space */
            padding: 2.5rem;
            
            /* Background and border matching the dark theme, using the charcoal variable */
            background: var(--charcoal); 
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius);
            
            /* Subtle glow/shadow effect to make it pop */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            transition: all 0.3s ease;
        }
        .login-card:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.7);
        }
        .login-heading {
            color: var(--cyan-accent);
            font-weight: 700;
            text-shadow: 0 0 5px rgba(0, 201, 255, 0.2);
        }
        .form-check-label {
            color: var(--cool-gray);
            font-size: 0.9rem;
        }
        /* Links in the dark card should use the cyan accent */
        .link-light {
            color: var(--cyan-accent);
            transition: color 0.2s;
            font-weight: 500;
        }
        .link-light:hover {
            color: #fff;
        }
        /* Style for inputs within the card */
        .form-control { 
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.15);
        }

        /* Checkbox specific styling for better alignment */
        .form-check-input {
            width: 1rem;
            height: 1rem;
            margin-right: 0.5rem;
            margin-top: 0; /* Important for alignment */
            flex-shrink: 0;
            cursor: pointer;
        }
    </style>

    <div class="login-card">
        <h2 class="h3 text-center login-heading mb-5">Sign In to Your Account</h2>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" class="form-label" />
                <x-text-input 
                    id="email" 
                    class="form-control" 
                    type="email" 
                    name="email" 
                    :value="old('email')" 
                    required 
                    autofocus 
                    autocomplete="username" 
                />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" class="form-label" />

                <x-text-input 
                    id="password" 
                    class="form-control"
                    type="password"
                    name="password"
                    required 
                    autocomplete="current-password" 
                />

                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            {{-- Remember Me and Forgot Password (Responsive and Aligned) --}}
            <div class="d-flex **flex-wrap** justify-content-between align-items-center mb-4 pt-2">
                
                {{-- Remember Me: Using d-flex and custom styles for alignment --}}
                <label for="remember_me" class="d-flex align-items-center form-check-label **mb-2**" style="cursor: pointer;">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    {{ __('Remember me') }}
                </label>
                
                @if (Route::has('password.request'))
                    <a class="link-light small" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            {{-- Log In Button (Full Width) --}}
            <div class="d-grid mt-4">
                <x-primary-button class="btn-primary">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
            
            {{-- Link to Register Page --}}
            <p class="text-center mt-4 small text-muted">
                Don't have an account? 
                <a href="{{ route('register') }}" class="link-light" style="font-weight: 600;">Sign Up</a>
            </p>
        </form>
    </div>
</x-guest-layout>