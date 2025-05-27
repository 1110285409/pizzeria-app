@extends('layouts.app')

@section('content')
<h1>Lista de Sucursales</h1>
<a href="{{ route('branches.create') }}">Nueva Sucursal</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($branches as $branch)
        <tr>
            <td>{{ $branch->name }}</td>
            <td>{{ $branch->address }}</td>
            <td>
                <a href="{{ route('branches.edit', $branch) }}">Editar</a>
                <form action="{{ route('branches.destroy', $branch) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('¿Eliminar sucursal?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
