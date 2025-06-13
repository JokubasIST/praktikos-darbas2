<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <title>Finansų ataskaita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #1e1e2f;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #f5f5f5;
            margin: 0;
            padding: 0;
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

        nav a:hover,
        nav a.active {
            color: #60f7d3;
            text-decoration: underline;
        }

        .btn-red {
            background-color: #ef4444;
            color: #fff;
            padding: 8px 16px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-red:hover {
            background-color: #f87171;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background: #29293d;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
        }

        h1, h2 {
            color: #60f7d3;
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #aefce3;
        }

        input[type="date"] {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: none;
            background-color: #1e1e2f;
            color: #f5f5f5;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.4);
        }

        button {
            background-color: #60f7d3;
            color: #1e1e2f;
            padding: 10px 20px;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #4be0c1;
        }

        p {
            margin-bottom: 8px;
            font-size: 1rem;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #20202e;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 12px rgba(96, 247, 211, 0.1);
        }

        th, td {
            padding: 12px 16px;
            text-align: left;
        }

        th {
            background-color: #181824;
            color: #60f7d3;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background-color: #2a2a3b;
        }

        tr:hover {
            background-color: #33334d;
            transition: background 0.3s;
        }

        form.inline {
            display: inline;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">Finansai<span>App</span></div>
    <nav>
        <a href="{{ route('home') }}">Pradžia</a>
        <a href="{{ route('transactions.index') }}">Įrašai</a>
        <a href="{{ route('categories.index') }}">Kategorijos</a>
        <a href="{{ route('reports.index') }}" class="active">Ataskaitos</a>

        @auth
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="btn-red">Atsijungti</button>
        </form>
        @endauth
    </nav>
</header>

<div class="container">
    <h1>Finansų ataskaita</h1>

    <form method="GET" action="{{ route('reports.index') }}">
        <label for="from">Nuo:</label>
        <input type="date" id="from" name="from" value="{{ $from }}">

        <label for="to">Iki:</label>
        <input type="date" id="to" name="to" value="{{ $to }}">

        <button type="submit">🔍 Filtruoti</button>
    </form>

    <h2>Santrauka</h2>
    <p><strong>Pajamos:</strong> €{{ number_format($income, 2) }}</p>
    <p><strong>Išlaidos:</strong> €{{ number_format($expenses, 2) }}</p>
    <p><strong>Likutis:</strong> €{{ number_format($balance, 2) }}</p>

    <h2>Pagal kategorijas</h2>
    <ul>
        @foreach ($byCategory as $name => $sum)
            <li>{{ $name }}: €{{ number_format($sum, 2) }}</li>
        @endforeach
    </ul>

    <h2>Detalūs įrašai</h2>
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Kategorija</th>
                <th>Tipas</th>
                <th>Suma</th>
                <th>Aprašymas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $t)
                <tr>
                    <td>{{ $t->date }}</td>
                    <td>{{ $t->category->name }}</td>
                    <td>{{ $t->category->type }}</td>
                    <td>€{{ number_format($t->amount, 2) }}</td>
                    <td>{{ $t->description }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
