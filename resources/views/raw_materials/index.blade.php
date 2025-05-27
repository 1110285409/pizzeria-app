@extends('layouts.app')

@section('content')
<h1>Materias Primas</h1>
<a href="{{ route('raw-materials.create') }}">Agregar Materia Prima</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Unidad</th>
            <th>Stock Actual</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rawMaterials as $raw)
        <tr>
            <td>{{ $raw->name }}</td>
            <td>{{ $raw->unit }}</td>
            <td>{{ $raw->current_stock }}</td>
            <td>
                <a href="{{ route('raw-materials.edit', $raw) }}">Editar</a>
                <form action="{{ route('raw-materials.destroy', $raw) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('¿Eliminar materia prima?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
