<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\RawMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with(['supplier', 'rawMaterial'])->orderByDesc('purchase_date')->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $rawMaterials = RawMaterial::all();
        return view('purchases.create', compact('suppliers', 'rawMaterials'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0.01',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        // Guardar compra
        $purchase = Purchase::create($validated);

        // Actualizar stock
        $purchase->rawMaterial->increment('current_stock', $validated['quantity']);

        return redirect()->route('purchases.index')->with('success', 'Compra registrada y stock actualizado');
    }

    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::all();
        $rawMaterials = RawMaterial::all();
        return view('purchases.edit', compact('purchase', 'suppliers', 'rawMaterials'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'quantity' => 'required|numeric|min:0.01',
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
        ]);

        // Ajustar el stock: restar el anterior, sumar el nuevo
        $oldQuantity = $purchase->quantity;
        $purchase->rawMaterial->decrement('current_stock', $oldQuantity);
        RawMaterial::find($validated['raw_material_id'])->increment('current_stock', $validated['quantity']);

        $purchase->update($validated);

        return redirect()->route('purchases.index')->with('success', 'Compra actualizada y stock ajustado');
    }

    public function destroy(Purchase $purchase)
    {
        // Al eliminar, restamos la cantidad del stock
        $purchase->rawMaterial->decrement('current_stock', $purchase->quantity);
        $purchase->delete();

        return redirect()->route('purchases.index')->with('success', 'Compra eliminada y stock actualizado');
    }
}
