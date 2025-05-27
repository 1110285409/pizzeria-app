@extends('layouts.app')

@section('content')
<h1>Compras Registradas</h1>
<a href="{{ route('purchases.create') }}">Nueva Compra</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th>Materia Prima</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($purchases as $purchase)
        <tr>
            <td>{{ \Carbon\Carbon::parse($purchase->purchase_date)->format('d/m/Y') }}</td>
            <td>{{ $purchase->supplier->name }}</td>
            <td>{{ $purchase->rawMaterial->name }}</td>
            <td>{{ $purchase->quantity }} {{ $purchase->rawMaterial->unit }}</td>
            <td>${{ $purchase->purchase_price }}</td>
            <td>${{ $purchase->quantity * $purchase->purchase_price }}</td>
            <td>
                <a href="{{ route('purchases.edit', $purchase) }}">Editar</a>
                <form action="{{ route('purchases.destroy', $purchase) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('¿Eliminar compra?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
