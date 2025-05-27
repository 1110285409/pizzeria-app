@extends('layouts.app')

@section('content')
<h1>Crear Nueva Pizza</h1>

@if ($errors->any())
    <div>
        <strong>Errores:</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('pizzas.store') }}">
    @csrf

    <label>Nombre de la Pizza:</label><br>
    <input type="text" name="name" value="{{ old('name') }}" required><br><br>

    <label>Tamaños y Precios:</label><br>
    @foreach(['pequeña', 'mediana', 'grande'] as $size)
        <div>
            <label>{{ ucfirst($size) }}:</label>
            <input type="hidden" name="sizes[{{ $loop->index }}][size]" value="{{ $size }}">
            <input type="number" step="0.01" name="sizes[{{ $loop->index }}][price]"
                   value="{{ old("sizes.$loop->index.price") }}"
                   placeholder="Precio de la {{ $size }}" required>
        </div>
    @endforeach
    <br>

    <label>Ingredientes:</label><br>
    @foreach($ingredients as $ingredient)
        <label>
            <input type="checkbox" name="ingredients[]" value="{{ $ingredient->id }}"
                {{ in_array($ingredient->id, old('ingredients', [])) ? 'checked' : '' }}>
            {{ $ingredient->name }}
        </label><br>
    @endforeach
    <br>

    <button type="submit">Crear Pizza</button>
</form>
@endsection
