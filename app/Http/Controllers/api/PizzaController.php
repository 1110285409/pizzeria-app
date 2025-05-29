<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Pizza;
use App\Models\PizzaSize;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        return Pizza::with('sizes')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:pizzas,name',
            'sizes' => 'required|array',
            'sizes.*.size' => 'required|in:pequeña,mediana,grande',
            'sizes.*.price' => 'required|numeric|min:0',
        ]);

        $pizza = Pizza::create(['name' => $request->name]);

        foreach ($request->sizes as $size) {
            $pizza->sizes()->create($size);
        }

        return $pizza->load('sizes');
    }

    public function show($id)
    {
        return Pizza::with('sizes')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $pizza = Pizza::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:pizzas,name,' . $pizza->id,
            'sizes' => 'required|array',
            'sizes.*.size' => 'required|in:pequeña,mediana,grande',
            'sizes.*.price' => 'required|numeric|min:0',
        ]);

        $pizza->update(['name' => $request->name]);
        $pizza->sizes()->delete();

        foreach ($request->sizes as $size) {
            $pizza->sizes()->create($size);
        }

        return $pizza->load('sizes');
    }

    public function destroy($id)
    {
        $pizza = Pizza::findOrFail($id);
        $pizza->sizes()->delete();
        $pizza->delete();
        return response()->json(null, 204);
    }
}
