<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('user')->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        return view('employees.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'position' => ['required', Rule::in(['cajero', 'administrador', 'cocinero', 'mensajero'])],
            'identification_number' => 'required|string|max:20',
            'salary' => 'required|numeric',
            'hire_date' => 'required|date',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'empleado',
        ]);

        Employee::create([
            'user_id' => $user->id,
            'position' => $validated['position'],
            'identification_number' => $validated['identification_number'],
            'salary' => $validated['salary'],
            'hire_date' => $validated['hire_date'],
        ]);

        return redirect()->route('employees.index')->with('success', 'Empleado registrado');
    }

    public function edit(Employee $employee)
    {
        $employee->load('user');
        return view('employees.edit', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($employee->user->id)],
            'position' => ['required', Rule::in(['cajero', 'administrador', 'cocinero', 'mensajero'])],
            'identification_number' => 'required|string|max:20',
            'salary' => 'required|numeric',
            'hire_date' => 'required|date',
        ]);

        $employee->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $employee->update([
            'position' => $validated['position'],
            'identification_number' => $validated['identification_number'],
            'salary' => $validated['salary'],
            'hire_date' => $validated['hire_date'],
        ]);

        return redirect()->route('employees.index')->with('success', 'Empleado actualizado');
    }

    public function destroy(Employee $employee)
    {
        $employee->user->delete(); // borra también el usuario
        return redirect()->route('employees.index')->with('success', 'Empleado eliminado');
    }
}
