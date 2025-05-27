@extends('layouts.app')

@section('content')
<h1>Editar Materia Prima</h1>

<form method="POST" action="{{ route('raw-materials.update', $rawMaterial) }}">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="name" value="{{ $rawMaterial->name }}" required><br>

    <label>Unidad:</label>
    <input type="text" name="unit" value="{{ $rawMaterial->unit }}" required><br>

    <label>Stock Actual:</label>
    <input type="number" step="0.01" name="current_stock" value="{{ $rawMaterial->current_stock }}" required><br>

    <button type="submit">Actualizar</button>
</form>
@endsection
