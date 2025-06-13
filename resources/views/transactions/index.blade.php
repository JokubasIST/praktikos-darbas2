@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #1e1e2f !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        color: #f5f5f5;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 40px;
        background-color: #181824;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .logo {
        color: white;
        font-weight: bold;
        font-size: 1.5rem;
    }

    .logo span {
        color: #60f7d3;
    }

    nav {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    nav a {
        color: #ffffff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
        padding-bottom: 2px;
    }

    nav a:hover {
        color: #60f7d3;
    }

    nav a.active {
        color: #60f7d3;
        font-weight: bold;
        border-bottom: 2px solid #60f7d3;
    }

    .btn-red {
        background-color: #ef4444;
        color: white;
        padding: 8px 14px;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .btn-red:hover {
        background-color: #dc2626;
    }

    .container {
        max-width: 1100px;
        margin: 40px auto;
        padding: 30px;
        background: #29293d;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    }

    h1 {
        font-size: 2rem;
        color: #60f7d3;
        margin-bottom: 30px;
        text-align: center;
    }

    a.button {
        background-color: #1e1e2f;
        color: #60f7d3;
        font-weight: 600;
        padding: 10px 16px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    a.button:hover {
        background-color: #60f7d3;
        color: #1e1e2f;
        transform: translateY(-1px);
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #20202e;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(96, 247, 211, 0.1);
    }

    th, td {
        padding: 14px 18px;
        text-align: left;
    }

    th {
        background-color: #181824;
        color: #60f7d3;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.6px;
    }

    td {
        color: #e4e4e7;
        font-size: 0.95rem;
    }

    tr:nth-child(even) {
        background-color: #2a2a3b;
    }

    tr:hover {
        background-color: #33334d;
        transition: background 0.3s;
    }

    .actions {
        display: flex;
        gap: 6px;
    }

    .actions a,
    .actions button {
        background-color: #1f1f2e;
        color: #fff;
        border: none;
        padding: 6px 10px;
        border-radius: 6px;
        cursor: pointer;
        transition: 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .actions a:hover,
    .actions button:hover {
        background-color: #60f7d3;
        color: #1e1e2f;
    }

    .actions form {
        display: inline;
    }

    p {
        background-color: #2e2e40;
        padding: 12px 16px;
        border-radius: 6px;
        color: #aefce3;
        margin-top: 15px;
    }
</style>

<header>
    <div class="logo">Finansai<span>App</span></div>
    <nav>
        <a href="{{ route('home') }}">Pradžia</a>
        <a href="{{ route('transactions.index') }}" class="active">Įrašai</a>
        <a href="{{ route('categories.index') }}">Kategorijos</a>
        <a href="{{ route('reports.index') }}">Ataskaitos</a>
        @auth
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="btn-red">Atsijungti</button>
        </form>
        @endauth
    </nav>
</header>

<div class="container">
    <h1>Pajamų ir išlaidų įrašai</h1>

    <a href="{{ route('transactions.create') }}" class="button">➕ Naujas įrašas</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>Kategorija</th>
                <th>Suma</th>
                <th>Data</th>
                <th>Aprašymas</th>
                <th>Veiksmai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transactions as $t)
            <tr>
                <td>{{ $t->category->name }}</td>
                <td>€{{ number_format($t->amount, 2) }}</td>
                <td>{{ $t->date }}</td>
                <td>{{ $t->description }}</td>
                <td class="actions">
                    <a href="{{ route('transactions.edit', $t) }}">✏️</a>
                    <form action="{{ route('transactions.destroy', $t) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">🗑️</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
