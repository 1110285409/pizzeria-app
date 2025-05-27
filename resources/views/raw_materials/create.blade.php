@extends('layouts.app')

@section('content')
<h1>Nueva Materia Prima</h1>

<form method="POST" action="{{ route('raw-materials.store') }}">
    @csrf

    <label>Nombre:</label>
    <input type="text" name="name" required><br>

    <label>Unidad (kg, litro, bolsa, etc):</label>
    <input type="text" name="unit" required><br>

    <label>Stock Inicial:</label>
    <input type="number" step="0.01" name="current_stock" required><br>

    <button type="submit">Guardar</button>
</form>
@endsection
