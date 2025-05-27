@extends('layouts.app')

@section('content')
<h1>Detalle del Pedido</h1>

<p><strong>Cliente:</strong> {{ $order->client->user->name }}</p>
<p><strong>Sucursal:</strong> {{ $order->branch->name }}</p>
<p><strong>Estado:</strong> {{ ucfirst(str_replace('_', ' ', $order->status)) }}</p>
<p><strong>Tipo:</strong> {{ $order->delivery_type === 'en_local' ? 'En local' : 'A domicilio' }}</p>
@if($order->delivery_type === 'a_domicilio')
    <p><strong>Mensajero:</strong> {{ $order->deliveryPerson->user->name ?? '-' }}</p>
@endif
<p><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>

<h3>Pizzas</h3>
<ul>
    @foreach($order->pizzas as $pizza)
        <li>{{ $pizza->pizza->name }} - {{ ucfirst($pizza->size) }} x {{ $pizza->pivot->quantity }} (${{ $pizza->price }})</li>
    @endforeach
</ul>

<h3>Ingredientes Extra</h3>
<ul>
    @foreach($order->extraIngredients as $extra)
        <li>{{ $extra->name }} x {{ $extra->pivot->quantity }} (${{ $extra->price }})</li>
    @endforeach
</ul>

<p><strong>Total:</strong> ${{ number_format($order->total_price, 2) }}</p>
<a href="{{ route('orders.index') }}">Volver</a>
@endsection
