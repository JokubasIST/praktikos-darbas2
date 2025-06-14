<x-guest-layout>
    <style>
        body {
            background-color: #1e1e2f !important;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f5f5f5;
        }

        .auth-card {
            max-width: 450px;
            margin: 50px auto;
            background-color: #29293d;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        label {
            color: #aefce3;
            font-weight: 600;
        }

        input {
            width: 100%;
            padding: 12px 15px;
            margin-top: 6px;
            margin-bottom: 16px;
            border: none;
            border-radius: 8px;
            background-color: #f5f5f5; /* Pakeista į šviesų foną */
            color: #1e1e2f; /* Tekstas juodas */
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.4);
        }

        input:focus {
            outline: none;
            box-shadow: 0 0 0 2px #60f7d3;
        }

        .btn {
            background-color: #60f7d3;
            color: #1e1e2f;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn:hover {
            background-color: #4be0c1;
        }

        a {
            color: #60f7d3;
            font-size: 0.9rem;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .logo-slot {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8rem;
            font-weight: bold;
            color: white;
        }

        .logo-slot span {
            color: #60f7d3;
        }

        .checkbox-label {
            color: #aefce3;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-me {
            margin-bottom: 16px;
        }

        .status-message {
            background-color: #2e2e40;
            padding: 12px 16px;
            border-radius: 6px;
            color: #aefce3;
            margin-bottom: 16px;
        }
    </style>

    <div class="auth-card">
        <div class="logo-slot">
            Finansai<span>App</span>
        </div>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="status-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <label for="email">{{ __('El. paštas') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
            </div>

            <div>
                <label for="password">{{ __('Slaptažodis') }}</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="remember-me">
                <label for="remember_me" class="checkbox-label">
                    <input type="checkbox" id="remember_me" name="remember">
                    {{ __('Prisiminti mane') }}
                </label>
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">{{ __('Pamiršote slaptažodį?') }}</a>
                @endif

                <button type="submit" class="btn">{{ __('Prisijungti') }}</button>
            </div>
        </form>
    </div>
</x-guest-layout>
