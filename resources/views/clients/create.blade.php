@extends('layouts.app')

@section('content')
<h1>Nuevo Cliente</h1>

<form action="{{ route('clients.store') }}" method="POST">
    @csrf
    <label>Nombre:</label>
    <input type="text" name="name" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br>

    <label>Confirmar Contraseña:</label>
    <input type="password" name="password_confirmation" required><br>

    <label>Dirección:</label>
    <input type="text" name="address"><br>

    <label>Teléfono:</label>
    <input type="text" name="phone"><br>

    <button type="submit">Guardar</button>
</form>
@endsection
