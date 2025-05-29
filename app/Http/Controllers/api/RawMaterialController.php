<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RawMaterial;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    public function index()
    {
        return RawMaterial::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:raw_materials,name',
            'unit' => 'required|string',
            'current_stock' => 'required|numeric|min:0',
        ]);

        return RawMaterial::create($request->all());
    }

    public function show($id)
    {
        return RawMaterial::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $material = RawMaterial::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:raw_materials,name,' . $id,
            'unit' => 'required|string',
            'current_stock' => 'required|numeric|min:0',
        ]);

        $material->update($request->all());

        return $material;
    }

    public function destroy($id)
    {
        $material = RawMaterial::findOrFail($id);
        $material->delete();
        return response()->json(null, 204);
    }
}
