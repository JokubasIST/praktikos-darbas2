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
            background-color: #f5f5f5; /* <-- Pakeista iš #1e1e2f */
            color: #1e1e2f; /* <-- Juodas tekstas */
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

        .terms {
            color: #aefce3;
            font-size: 0.85rem;
            margin-top: 10px;
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
    </style>

    <div class="auth-card">
        <div class="logo-slot">
            Finansai<span>App</span>
        </div>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name">{{ __('Vardas') }}</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            </div>

            <div>
                <label for="email">{{ __('El. paštas') }}</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
            </div>

            <div>
                <label for="password">{{ __('Slaptažodis') }}</label>
                <input id="password" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div>
                <label for="password_confirmation">{{ __('Pakartokite slaptažodį') }}</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="terms">
                    <label for="terms">
                        <input type="checkbox" name="terms" id="terms" required>
                        {!! __('Sutinku su :terms ir :privacy', [
                            'terms' => '<a href="'.route('terms.show').'" target="_blank">naudojimo taisyklėmis</a>',
                            'privacy' => '<a href="'.route('policy.show').'" target="_blank">privatumo politika</a>',
                        ]) !!}
                    </label>
                </div>
            @endif

            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('login') }}">{{ __('Jau turite paskyrą?') }}</a>
                <button type="submit" class="btn">{{ __('Registruotis') }}</button>
            </div>
        </form>
    </div>
</x-guest-layout>
