@extends('layouts.app')

@section('content')
<h1>Clientes</h1>
<a href="{{ route('clients.create') }}">Nuevo cliente</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
            <tr>
                <td>{{ $client->user->name }}</td>
                <td>{{ $client->user->email }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->address }}</td>
                <td>
                    <a href="{{ route('clients.edit', $client) }}">Editar</a>
                    <form action="{{ route('clients.destroy', $client) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('¿Eliminar cliente?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
