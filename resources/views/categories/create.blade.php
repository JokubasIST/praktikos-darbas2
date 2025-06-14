@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #0f0f2d;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #f5f5f5;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 50px auto;
        padding: 30px;
        background: #1b1b2e;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
    }

    h1 {
        text-align: center;
        font-size: 2rem;
        color: #60f7d3;
        margin-bottom: 30px;
    }

    .back-link {
        display: inline-block;
        margin-bottom: 20px;
        background-color: #1e1e2f;
        color: #60f7d3;
        padding: 8px 16px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .back-link:hover {
        background-color: #2a2a40;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #aefce3;
    }

    input[type="text"], select {
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

    input[type="text"]::placeholder {
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
        width: 100%;
    }

    button:hover {
        background-color: #4be0c1;
    }
</style>

<div class="container">
    <a href="{{ route('categories.index') }}" class="back-link">← Grįžti į kategoriją</a>

    <h1>Nauja kategorija</h1>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <label for="name">Pavadinimas:</label>
        <input type="text" name="name" id="name" placeholder="Pvz. maisto prekės" required>

        <label for="type">Tipas:</label>
        <select name="type" id="type">
            <option value="pajamos">Pajamos</option>
            <option value="islaidos">Išlaidos</option>
        </select>

        <button type="submit">💾 Išsaugoti</button>
    </form>
</div>
@endsection
