<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('user')->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'cliente',
        ]);

        Client::create([
            'user_id' => $user->id,
            'address' => $validated['address'],
            'phone' => $validated['phone'],
        ]);

        return redirect()->route('clients.index')->with('success', 'Cliente creado correctamente');
    }

    public function edit(Client $client)
    {
        $client->load('user');
        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users','email')->ignore($client->user->id)],
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $client->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $client->update([
            'address' => $validated['address'],
            'phone' => $validated['phone'],
        ]);

        return redirect()->route('clients.index')->with('success', 'Cliente actualizado');
    }

    public function destroy(Client $client)
    {
        $client->user->delete(); // elimina también al usuario
        return redirect()->route('clients.index')->with('success', 'Cliente eliminado');
    }
}
