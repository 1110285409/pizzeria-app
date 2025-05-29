<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index()
    {
        return Branch::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:branches,name',
            'address' => 'required|string'
        ]);

        return Branch::create($request->only(['name', 'address']));
    }

    public function show($id)
    {
        return Branch::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $request->validate([
            'name' => 'required|string|unique:branches,name,' . $id,
            'address' => 'required|string'
        ]);

        $branch->update($request->only(['name', 'address']));

        return $branch;
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return response()->json(null, 204);
    }
}
