@extends('layouts.app')

@section('content')
<h1>Listado de Pizzas</h1>
<a href="{{ route('pizzas.create') }}">Crear Pizza</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@foreach($pizzas as $pizza)
    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px;">
        <h3>{{ $pizza->name }}</h3>
        <p><strong>Tamaños:</strong></p>
        <ul>
            @foreach($pizza->sizes as $size)
                <li>{{ ucfirst($size->size) }} - ${{ $size->price }}</li>
            @endforeach
        </ul>

        <p><strong>Ingredientes:</strong> {{ $pizza->ingredients->pluck('name')->join(', ') }}</p>

        <a href="{{ route('pizzas.edit', $pizza) }}">Editar</a>
        <form action="{{ route('pizzas.destroy', $pizza) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    </div>
@endforeach
@endsection
