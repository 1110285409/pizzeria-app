@extends('layouts.app')

@section('content')
<h1>Editar Empleado</h1>

<form action="{{ route('employees.update', $employee) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre:</label>
    <input type="text" name="name" value="{{ $employee->user->name }}" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="{{ $employee->user->email }}" required><br>

    <label>Cargo:</label>
    <select name="position" required>
        @foreach(['administrador', 'cajero', 'cocinero', 'mensajero'] as $cargo)
            <option value="{{ $cargo }}" {{ $employee->position === $cargo ? 'selected' : '' }}>{{ ucfirst($cargo) }}</option>
        @endforeach
    </select><br>

    <label>Número de Identificación:</label>
    <input type="text" name="identification_number" value="{{ $employee->identification_number }}" required><br>

    <label>Salario:</label>
    <input type="number" step="0.01" name="salary" value="{{ $employee->salary }}" required><br>

    <label>Fecha de Contratación:</label>
    <input type="date" name="hire_date" value="{{ $employee->hire_date }}" required><br>

    <button type="submit">Actualizar</button>
</form>
@endsection
