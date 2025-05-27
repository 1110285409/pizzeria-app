@extends('layouts.app')

@section('content')
<h1>Nueva Compra</h1>

<form method="POST" action="{{ route('purchases.store') }}">
    @csrf

    <label>Proveedor:</label>
    <select name="supplier_id" required>
        @foreach($suppliers as $supplier)
            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
        @endforeach
    </select><br>

    <label>Materia Prima:</label>
    <select name="raw_material_id" required>
        @foreach($rawMaterials as $raw)
            <option value="{{ $raw->id }}">{{ $raw->name }}</option>
        @endforeach
    </select><br>

    <label>Cantidad:</label>
    <input type="number" step="0.01" name="quantity" required><br>

    <label>Precio Unitario:</label>
    <input type="number" step="0.01" name="purchase_price" required><br>

    <label>Fecha de Compra:</label>
    <input type="date" name="purchase_date" value="{{ now()->toDateString() }}" required><br>

    <button type="submit">Guardar</button>
</form>
@endsection
