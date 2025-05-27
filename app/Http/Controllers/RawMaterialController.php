<?php

namespace App\Http\Controllers;

use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    public function index()
    {
        $rawMaterials = RawMaterial::all();
        return view('raw_materials.index', compact('rawMaterials'));
    }

    public function create()
    {
        return view('raw_materials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:raw_materials,name',
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|numeric|min:0',
        ]);

        RawMaterial::create($validated);

        return redirect()->route('raw-materials.index')->with('success', 'Materia prima creada');
    }

    public function edit(RawMaterial $rawMaterial)
    {
        return view('raw_materials.edit', compact('rawMaterial'));
    }

    public function update(Request $request, RawMaterial $rawMaterial)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:raw_materials,name,' . $rawMaterial->id,
            'unit' => 'required|string|max:50',
            'current_stock' => 'required|numeric|min:0',
        ]);

        $rawMaterial->update($validated);

        return redirect()->route('raw-materials.index')->with('success', 'Materia prima actualizada');
    }

    public function destroy(RawMaterial $rawMaterial)
    {
        $rawMaterial->delete();
        return redirect()->route('raw-materials.index')->with('success', 'Materia prima eliminada');
    }
}
