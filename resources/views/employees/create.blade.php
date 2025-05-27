@extends('layouts.app')

@section('content')
<h1>Nuevo Empleado</h1>

<form action="{{ route('employees.store') }}" method="POST">
    @csrf

    <label>Nombre:</label>
    <input type="text" name="name" required><br>

    <label>Email:</label>
    <input type="email" name="email" required><br>

    <label>Contraseña:</label>
    <input type="password" name="password" required><br>

    <label>Confirmar Contraseña:</label>
    <input type="password" name="password_confirmation" required><br>

    <label>Cargo:</label>
    <select name="position" required>
        <option value="">Seleccione...</option>
        <option value="administrador">Administrador</option>
        <option value="cajero">Cajero</option>
        <option value="cocinero">Cocinero</option>
        <option value="mensajero">Mensajero</option>
    </select><br>

    <label>Número de Identificación:</label>
    <input type="text" name="identification_number" required><br>

    <label>Salario:</label>
    <input type="number" step="0.01" name="salary" required><br>

    <label>Fecha de Contratación:</label>
    <input type="date" name="hire_date" required><br>

    <button type="submit">Registrar</button>
</form>
@endsection
