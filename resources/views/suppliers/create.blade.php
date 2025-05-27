@extends('layouts.app')

@section('content')
<h1>Nuevo Proveedor</h1>

<form method="POST" action="{{ route('suppliers.store') }}">
    @csrf

    <label>Nombre:</label>
    <input type="text" name="name" required><br>

    <label>Información de contacto:</label>
    <input type="text" name="contact_info"><br>

    <button type="submit">Guardar</button>
</form>
@endsection
