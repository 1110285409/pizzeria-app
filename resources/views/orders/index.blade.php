@extends('layouts.app')

@section('content')
<h1>Pedidos</h1>
<a href="{{ route('orders.create') }}">Nuevo Pedido</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Sucursal</th>
            <th>Estado</th>
            <th>Total</th>
            <th>Tipo</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->client->user->name }}</td>
            <td>{{ $order->branch->name }}</td>
            <td>
                <form method="POST" action="{{ route('orders.update.status', $order) }}">
                    @csrf
                    @method('PATCH')
                    <select name="status" onchange="this.form.submit()">
                        @foreach(['pendiente', 'en_preparacion', 'listo', 'entregado'] as $estado)
                            <option value="{{ $estado }}" {{ $order->status === $estado ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('_', ' ', $estado)) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </td>
            <td>${{ number_format($order->total_price, 2) }}</td>
            <td>{{ $order->delivery_type === 'en_local' ? 'En local' : 'A domicilio' }}</td>
            <td>{{ $order->created_at->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('orders.show', $order) }}">Ver</a>
                <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('¿Eliminar pedido?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
