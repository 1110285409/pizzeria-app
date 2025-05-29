<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        return Employee::with('user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'position' => 'required|in:cajero,administrador,cocinero,mensajero',
            'identification_number' => 'required|string',
            'salary' => 'required|numeric',
            'hire_date' => 'required|date',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'empleado',
        ]);

        return Employee::create([
            'user_id' => $user->id,
            'position' => $validated['position'],
            'identification_number' => $validated['identification_number'],
            'salary' => $validated['salary'],
            'hire_date' => $validated['hire_date'],
        ]);
    }

    public function show($id)
    {
        return Employee::with('user')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::with('user')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $employee->user_id,
            'position' => 'required|in:cajero,administrador,cocinero,mensajero',
            'identification_number' => 'required|string',
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

        return $employee;
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->user()->delete();
        return response()->json(null, 204);
    }
}
