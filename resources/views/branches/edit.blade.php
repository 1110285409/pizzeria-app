@extends('layouts.app')

@section('content')
<h1>Editar Sucursal</h1>

<form method="POST" action="{{ route('branches.update', $branch) }}">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="name" value="{{ $branch->name }}" required><br>

    <label>Dirección:</label>
    <input type="text" name="address" value="{{ $branch->address }}" required><br>

    <button type="submit">Actualizar</button>
</form>
@endsection
