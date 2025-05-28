<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pizza;

class PizzaController extends Controller
{
    public function index()
    {
        return response()->json([
            ['id' => 1, 'nombre' => 'Margarita', 'precio' => 8.99],
            ['id' => 2, 'nombre' => 'Pepperoni', 'precio' => 10.50],
            ['id' => 3, 'nombre' => 'Hawaiana', 'precio' => 9.75],
        ]);
    } 

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $pizza = Pizza::create($request->all());
        return response()->json($pizza, 201);
    }

    public function show($id)
{
    $pizza = Pizza::find($id);

    if (!$pizza) {
        return response()->json(['error' => 'Pizza no encontrada'], 404);
    }

    return response()->json($pizza);
}

public function update(Request $request, $id)
{
    $pizza = Pizza::find($id);

    if (!$pizza) {
        return response()->json(['error' => 'Pizza no encontrada'], 404);
    }

    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $pizza->update($request->all());

    return response()->json($pizza);
}

public function destroy($id)
{
    $pizza = Pizza::find($id);

    if (!$pizza) {
        return response()->json(['error' => 'Pizza no encontrada'], 404);
    }

    $pizza->delete();

    return response()->json(['message' => 'Pizza eliminada']);
}


    
}