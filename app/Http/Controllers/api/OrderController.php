<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PizzaSize;
use App\Models\ExtraIngredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        return Order::with(['client.user', 'pizzas', 'extraIngredients'])->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'delivery_type' => 'required|in:en_local,a_domicilio',
            'delivery_person_id' => 'nullable|exists:employees,id',
            'pizzas' => 'required|array',
            'pizzas.*.pizza_size_id' => 'required|exists:pizza_size,id',
            'pizzas.*.quantity' => 'required|integer|min:1',
            'extras' => 'nullable|array',
            'extras.*.extra_ingredient_id' => 'exists:extra_ingredients,id',
            'extras.*.quantity' => 'required_with:extras.*.extra_ingredient_id|integer|min:1',
        ]);

        $order = DB::transaction(function () use ($validated) {
            $order = Order::create([
                'client_id' => $validated['client_id'],
                'delivery_type' => $validated['delivery_type'],
                'delivery_person_id' => $validated['delivery_type'] === 'a_domicilio'
                    ? $validated['delivery_person_id']
                    : null,
                'status' => 'pendiente',
                'total_price' => 0,
            ]);

            $total = 0;

            foreach ($validated['pizzas'] as $item) {
                $pizzaSize = PizzaSize::find($item['pizza_size_id']);
                $subtotal = $pizzaSize->price * $item['quantity'];
                $order->pizzas()->attach($pizzaSize->id, ['quantity' => $item['quantity']]);
                $total += $subtotal;
            }

            if (!empty($validated['extras'])) {
                foreach ($validated['extras'] as $item) {
                    $extra = ExtraIngredient::find($item['extra_ingredient_id']);
                    $subtotal = $extra->price * $item['quantity'];
                    $order->extraIngredients()->attach($extra->id, ['quantity' => $item['quantity']]);
                    $total += $subtotal;
                }
            }

            $order->update(['total_price' => $total]);

            return $order->load('pizzas', 'extraIngredients');
        });

        return $order;
    }

    public function show($id)
    {
        return Order::with(['client.user', 'pizzas', 'extraIngredients'])->findOrFail($id);
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->pizzas()->detach();
        $order->extraIngredients()->detach();
        $order->delete();
        return response()->json(null, 204);
    }
}
