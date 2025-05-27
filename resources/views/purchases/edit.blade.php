@extends('layouts.app')

@section('content')
<h1>Editar Compra</h1>

<form method="POST" action="{{ route('purchases.update', $purchase) }}">
    @csrf
    @method('PUT')

    <label>Proveedor:</label>
    <select name="supplier_id" required>
        @foreach($suppliers as $supplier)
            <option value="{{ $supplier->id }}" {{ $purchase->supplier_id == $supplier->id ? 'selected' : '' }}>
                {{ $supplier->name }}
            </option>
        @endforeach
    </select><br>

    <label>Materia Prima:</label>
    <select name="raw_material_id" required>
        @foreach($rawMaterials as $raw)
            <option value="{{ $raw->id }}" {{ $purchase->raw_material_id == $raw->id ? 'selected' : '' }}>
                {{ $raw->name }}
            </option>
        @endforeach
    </select><br>

    <label>Cantidad:</label>
    <input type="number" step="0.01" name="quantity" value="{{ $purchase->quantity }}" required><br>

    <label>Precio Unitario:</label>
    <input type="number" step="0.01" name="purchase_price" value="{{ $purchase->purchase_price }}" required><br>

    <label>Fecha:</label>
    <input type="date" name="purchase_date" value="{{ $purchase->purchase_date->format('Y-m-d') }}" required><br>

    <button type="submit">Actualizar</button>
</form>
@endsection
