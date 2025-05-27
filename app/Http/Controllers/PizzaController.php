<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\PizzaSize;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::with(['sizes', 'ingredients'])->get();
        return view('pizzas.index', compact('pizzas'));
    }

    public function create()
    {
        $ingredients = Ingredient::all();
        return view('pizzas.create', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sizes' => 'required|array',
            'sizes.*.size' => 'required|in:pequeña,mediana,grande',
            'sizes.*.price' => 'required|numeric|min:0',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'exists:ingredients,id',
        ]);

        $pizza = Pizza::create(['name' => $validated['name']]);

        foreach ($validated['sizes'] as $size) {
            $pizza->sizes()->create($size);
        }

        if (!empty($validated['ingredients'])) {
            $pizza->ingredients()->sync($validated['ingredients']);
        }

        return redirect()->route('pizzas.index')->with('success', 'Pizza creada correctamente');
    }

    public function edit(Pizza $pizza)
    {
        $pizza->load(['sizes', 'ingredients']);
        $ingredients = Ingredient::all();
        return view('pizzas.edit', compact('pizza', 'ingredients'));
    }

    public function update(Request $request, Pizza $pizza)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sizes' => 'required|array',
            'sizes.*.id' => 'nullable|exists:pizza_size,id',
            'sizes.*.size' => 'required|in:pequeña,mediana,grande',
            'sizes.*.price' => 'required|numeric|min:0',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'exists:ingredients,id',
        ]);

        $pizza->update(['name' => $validated['name']]);

        $pizza->sizes()->delete();
        foreach ($validated['sizes'] as $size) {
            $pizza->sizes()->create([
                'size' => $size['size'],
                'price' => $size['price']
            ]);
        }

        $pizza->ingredients()->sync($validated['ingredients'] ?? []);

        return redirect()->route('pizzas.index')->with('success', 'Pizza actualizada');
    }

    public function destroy(Pizza $pizza)
    {
        $pizza->sizes()->delete();
        $pizza->ingredients()->detach();
        $pizza->delete();

        return redirect()->route('pizzas.index')->with('success', 'Pizza eliminada');
    }
}

