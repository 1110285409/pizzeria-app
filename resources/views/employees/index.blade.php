@extends('layouts.app')

@section('content')
<h1>Lista de Empleados</h1>
<a href="{{ route('employees.create') }}">Nuevo Empleado</a>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Identificación</th>
            <th>Salario</th>
            <th>Fecha de Contrato</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $employee)
        <tr>
            <td>{{ $employee->user->name }}</td>
            <td>{{ $employee->user->email }}</td>
            <td>{{ ucfirst($employee->position) }}</td>
            <td>{{ $employee->identification_number }}</td>
            <td>${{ $employee->salary }}</td>
            <td>{{ $employee->hire_date }}</td>
            <td>
                <a href="{{ route('employees.edit', $employee) }}">Editar</a>
                <form action="{{ route('employees.destroy', $employee) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button onclick="return confirm('¿Eliminar empleado?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
