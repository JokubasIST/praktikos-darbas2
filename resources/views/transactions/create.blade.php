<div class="container">
    <h1>Naujas įrašas</h1>

    <a href="{{ route('transactions.index') }}" class="back-button">
        ← Grįžti į įrašų sąrašą
    </a>

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

        <button type="submit" class="save-button">💾 Išsaugoti</button>
    </form>
</div>

<style>
    body {
        background-color: #1e1e2f;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        color: #f5f5f5;
    }

    .container {
        max-width: 600px;
        margin: 60px auto;
        padding: 40px;
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

    .back-button {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 16px;
        background-color: #1e1e2f;
        color: #60f7d3;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        transition: 0.3s;
    }

    .back-button:hover {
        background-color: #60f7d3;
        color: #1e1e2f;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #aefce3;
        margin-top: 15px;
    }

    input, select {
        width: 100%;
        padding: 12px 15px;
        border-radius: 8px;
        border: none;
        background-color: #1e1e2f;
        color: #f5f5f5;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.4);
        margin-bottom: 15px;
        font-size: 1rem;
    }

    input::placeholder {
        color: #999;
    }

    .save-button {
        display: inline-block;
        width: 100%;
        background-color: #60f7d3;
        color: #1e1e2f;
        padding: 12px;
        font-size: 1rem;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .save-button:hover {
        background-color: #4be0c1;
    }
</style>
