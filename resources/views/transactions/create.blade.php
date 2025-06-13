@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #1e1e2f;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background: #29293d;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
    }

    h1 {
        text-align: center;
        font-size: 2rem;
        color: #60f7d3;
        margin-bottom: 30px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #aefce3;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    select {
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 20px;
        border-radius: 8px;
        border: none;
        background-color: #1e1e2f;
        color: #f5f5f5;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.4);
        font-size: 1rem;
    }

    input::placeholder {
        color: #999;
    }

    button {
        background-color: #60f7d3;
        color: #1e1e2f;
        padding: 12px 20px;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    button:hover {
        background-color: #4be0c1;
    }
</style>

<div class="container">
    <h1>Naujas įrašas</h1>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf

        <label for="category_id">Kategorija:</label>
        <select name="category_id" id="category_id" required>
            @foreach ($categories as $c)
                <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->type }})</option>
            @endforeach
        </select>

        <label for="amount">Suma:</label>
        <input type="number" step="0.01" name="amount" id="amount" required>

        <label for="date">Data:</label>
        <input type="date" name="date" id="date" required>

        <label for="description">Aprašymas:</label>
        <input type="text" name="description" id="description" placeholder="Pvz. gauta alga">

        <button type="submit">💾 Išsaugoti</button>
    </form>
</div>
@endsection
