<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Asmeninių finansų apskaita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1e1e2f;
            color: #f5f5f5;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background-color: #29293d;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .logo span {
            color: #60f7d3;
        }

        nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        nav a {
            color: #f5f5f5;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        nav a:hover {
            color: #60f7d3;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.3s ease;
            text-decoration: none;
        }

        .btn-blue {
            background-color: #60f7d3;
            color: #1e1e2f;
        }

        .btn-blue:hover {
            background-color: #4be0c1;
        }

        .btn-green {
            background-color: #4ade80;
            color: #1e1e2f;
        }

        .btn-green:hover {
            background-color: #22c55e;
        }

        .btn-red {
            background-color: #ef4444;
            color: #fff;
            border: none;
        }

        .btn-red:hover {
            background-color: #f87171;
        }

        main {
            padding: 4rem 2rem;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: #60f7d3;
        }

        p {
            color: #cbd5e1;
            font-size: 1.2rem;
        }

        form {
            display: inline;
        }
    </style>
</head>
<body>
    <!-- Navigacija -->
    <header>
        <!-- Logotipas -->
        <div class="logo">
            Finansai<span>App</span>
        </div>

        <!-- Nuorodos -->
        <nav>
            <a href="{{ route('home') }}">Pradžia</a>

            @auth
                <a href="{{ route('transactions.index') }}">Įrašai</a>
                <a href="{{ route('categories.index') }}">Kategorijos</a>
                <a href="{{ route('reports.index') }}">Ataskaitos</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-red">Atsijungti</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-blue">Prisijungti</a>
                <a href="{{ route('register') }}" class="btn btn-green">Registruotis</a>
            @endauth
        </nav>
    </header>

    <!-- Turinys -->
    <main>
        <h1>Asmeninių finansų apskaita</h1>
        <p>Valdykite pajamas, išlaidas ir ataskaitas vienoje vietoje.</p>
    </main>
</body>
</html>
