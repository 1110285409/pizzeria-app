@extends('layouts.app')

@section('content')
<h1>Proveedores</h1>
<a href="{{ route('suppliers.create') }}">Nuevo Proveedor</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Contacto</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($suppliers as $supplier)
        <tr>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->contact_info }}</td>
            <td>
                <a href="{{ route('suppliers.edit', $supplier) }}">Editar</a>
                <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('¿Eliminar proveedor?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
