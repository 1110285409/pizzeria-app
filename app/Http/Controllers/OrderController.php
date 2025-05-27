<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Client;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\PizzaSize;
use App\Models\ExtraIngredient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['client.user', 'branch', 'deliveryPerson'])->orderByDesc('created_at')->get();
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $clients = Client::with('user')->get();
        $branches = Branch::all();
        $pizzas = PizzaSize::with('pizza')->get();
        $extraIngredients = ExtraIngredient::all();
        $mensajeros = Employee::where('position', 'mensajero')->get();

        return view('orders.create', compact('clients', 'branches', 'pizzas', 'extraIngredients', 'mensajeros'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'branch_id' => 'required|exists:branches,id',
            'delivery_type' => 'required|in:en_local,a_domicilio',
            'delivery_person_id' => 'nullable|exists:employees,id',
            'pizzas' => 'required|array',
            'pizzas.*.pizza_size_id' => 'required|exists:pizza_size,id',
            'pizzas.*.quantity' => 'required|integer|min:1',
            'extras' => 'nullable|array',
            'extras.*.extra_ingredient_id' => 'exists:extra_ingredients,id',
            'extras.*.quantity' => 'required_with:extras.*.extra_ingredient_id|integer|min:1',
        ]);

        DB::transaction(function () use ($validated) {
            $total = 0;

            $order = Order::create([
                'client_id' => $validated['client_id'],
                'branch_id' => $validated['branch_id'],
                'status' => 'pendiente',
                'delivery_type' => $validated['delivery_type'],
                'delivery_person_id' => $validated['delivery_type'] === 'a_domicilio'
                    ? $validated['delivery_person_id'] ?? null
                    : null,
                'total_price' => 0
            ]);

            // Pizzas
            foreach ($validated['pizzas'] as $pizzaItem) {
                $pizzaSize = PizzaSize::find($pizzaItem['pizza_size_id']);
                $subtotal = $pizzaSize->price * $pizzaItem['quantity'];
                $order->pizzas()->attach($pizzaSize->id, [
                    'quantity' => $pizzaItem['quantity']
                ]);
                $total += $subtotal;
            }

            // Ingredientes Extra
            if (!empty($validated['extras'])) {
                foreach ($validated['extras'] as $extraItem) {
                    $extra = ExtraIngredient::find($extraItem['extra_ingredient_id']);
                    $subtotal = $extra->price * $extraItem['quantity'];
                    $order->extraIngredients()->attach($extra->id, [
                        'quantity' => $extraItem['quantity']
                    ]);
                    $total += $subtotal;
                }
            }

            $order->update(['total_price' => $total]);
        });

        return redirect()->route('orders.index')->with('success', 'Pedido registrado correctamente');
    }

    public function show(Order $order)
    {
        $order->load(['client.user', 'branch', 'deliveryPerson', 'pizzas', 'extraIngredients']);
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        // No se implementará edición completa en este CRUD por complejidad
        return back()->with('error', 'La edición de pedidos no está disponible');
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pendiente,en_preparacion,listo,entregado'
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('orders.index')->with('success', 'Estado del pedido actualizado');
    }

    public function destroy(Order $order)
    {
        $order->pizzas()->detach();
        $order->extraIngredients()->detach();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pedido eliminado');
    }
}
