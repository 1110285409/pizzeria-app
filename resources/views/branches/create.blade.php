@extends('layouts.app')

@section('content')
<h1>Nueva Sucursal</h1>

<form method="POST" action="{{ route('branches.store') }}">
    @csrf

    <label>Nombre:</label>
    <input type="text" name="name" required><br>

    <label>Dirección:</label>
    <input type="text" name="address" required><br>

    <button type="submit">Guardar</button>
</form>
@endsection
