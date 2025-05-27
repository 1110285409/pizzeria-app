@extends('layouts.app')

@section('content')
<h1>Editar Cliente</h1>

<form action="{{ route('clients.update', $client) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="name" value="{{ $client->user->name }}" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ $client->user->email }}" required><br>

    <label>Dirección:</label>
    <input type="text" name="address" value="{{ $client->address }}"><br>

    <label>Teléfono:</label>
    <input type="text" name="phone" value="{{ $client->phone }}"><br>

    <button type="submit">Actualizar</button>
</form>
@endsection
