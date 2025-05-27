<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\RawMaterial;
use Illuminate\Http\Request;

class PizzaRawMaterialController extends Controller
{
    public function edit(Pizza $pizza)
    {
        $rawMaterials = RawMaterial::all();
        $current = $pizza->rawMaterials()->pluck('pizza_raw_material.quantity', 'raw_material_id')->toArray();

        return view('pizzas.raw_materials.edit', compact('pizza', 'rawMaterials', 'current'));
    }

    public function update(Request $request, Pizza $pizza)
    {
        $validated = $request->validate([
            'raw_materials' => 'nullable|array',
            'raw_materials.*' => 'nullable|numeric|min:0',
        ]);

        $syncData = [];
        foreach ($validated['raw_materials'] ?? [] as $materialId => $qty) {
            if ($qty > 0) {
                $syncData[$materialId] = ['quantity' => $qty];
            }
        }

        $pizza->rawMaterials()->sync($syncData);

        return redirect()->route('pizzas.index')->with('success', 'Materias primas asignadas correctamente');
    }
}
