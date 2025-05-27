@extends('layouts.app')

@section('content')
<h1>Editar Proveedor</h1>

<form method="POST" action="{{ route('suppliers.update', $supplier) }}">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="name" value="{{ $supplier->name }}" required><br>

    <label>Información de contacto:</label>
    <input type="text" name="contact_info" value="{{ $supplier->contact_info }}"><br>

    <button type="submit">Actualizar</button>
</form>
@endsection
