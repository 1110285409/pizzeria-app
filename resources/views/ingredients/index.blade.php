@extends('layouts.app')

@section('content')
<h1>Lista de Ingredientes</h1>
<a href="{{ route('ingredients.create') }}">Nuevo Ingrediente</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ingredients as $ingredient)
        <tr>
            <td>{{ $ingredient->name }}</td>
            <td>
                <a href="{{ route('ingredients.edit', $ingredient) }}">Editar</a>
                <form action="{{ route('ingredients.destroy', $ingredient) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('¿Eliminar ingrediente?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
