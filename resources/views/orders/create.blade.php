@extends('layouts.app')

@section('content')
<h1>Nuevo Pedido</h1>

<form method="POST" action="{{ route('orders.store') }}">
    @csrf

    <label>Cliente:</label>
    <select name="client_id" required>
        @foreach($clients as $client)
            <option value="{{ $client->id }}">{{ $client->user->name }}</option>
        @endforeach
    </select><br>

    <label>Sucursal:</label>
    <select name="branch_id" required>
        @foreach($branches as $branch)
            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
        @endforeach
    </select><br>

    <label>Tipo de entrega:</label>
    <select name="delivery_type" required id="delivery_type">
        <option value="en_local">En local</option>
        <option value="a_domicilio">A domicilio</option>
    </select><br>

    <div id="mensajero_section" style="display: none;">
        <label>Mensajero:</label>
        <select name="delivery_person_id">
            <option value="">-- Selecciona un mensajero --</option>
            @foreach($mensajeros as $m)
                <option value="{{ $m->id }}">{{ $m->user->name }}</option>
            @endforeach
        </select><br>
    </div>

    <h3>Pizzas</h3>
    <div id="pizza_section">
        <div>
            <select name="pizzas[0][pizza_size_id]">
                @foreach($pizzas as $pizza)
                    <option value="{{ $pizza->id }}">{{ $pizza->pizza->name }} - {{ ucfirst($pizza->size) }} (${{ $pizza->price }})</option>
                @endforeach
            </select>
            <input type="number" name="pizzas[0][quantity]" min="1" placeholder="Cantidad" required>
        </div>
    </div>

    <button type="button" onclick="addPizza()">+ Pizza</button>

    <h3>Ingredientes Extra</h3>
    <div id="extras_section">
        <div>
            <select name="extras[0][extra_ingredient_id]">
                @foreach($extraIngredients as $extra)
                    <option value="{{ $extra->id }}">{{ $extra->name }} (${{ $extra->price }})</option>
                @endforeach
            </select>
            <input type="number" name="extras[0][quantity]" min="1" placeholder="Cantidad">
        </div>
    </div>

    <button type="button" onclick="addExtra()">+ Ingrediente Extra</button><br><br>

    <button type="submit">Guardar Pedido</button>
</form>

<script>
    document.getElementById('delivery_type').addEventListener('change', function () {
        document.getElementById('mensajero_section').style.display = this.value === 'a_domicilio' ? 'block' : 'none';
    });

    let pizzaIndex = 1;
    function addPizza() {
        const container = document.getElementById('pizza_section');
        const div = document.createElement('div');
        div.innerHTML = `
            <select name="pizzas[${pizzaIndex}][pizza_size_id]">
                @foreach($pizzas as $pizza)
                    <option value="{{ $pizza->id }}">{{ $pizza->pizza->name }} - {{ ucfirst($pizza->size) }} (${{ $pizza->price }})</option>
                @endforeach
            </select>
            <input type="number" name="pizzas[${pizzaIndex}][quantity]" min="1" placeholder="Cantidad" required>
        `;
        container.appendChild(div);
        pizzaIndex++;
    }

    let extraIndex = 1;
    function addExtra() {
        const container = document.getElementById('extras_section');
        const div = document.createElement('div');
        div.innerHTML = `
            <select name="extras[${extraIndex}][extra_ingredient_id]">
                @foreach($extraIngredients as $extra)
                    <option value="{{ $extra->id }}">{{ $extra->name }} (${{ $extra->price }})</option>
                @endforeach
            </select>
            <input type="number" name="extras[${extraIndex}][quantity]" min="1" placeholder="Cantidad">
        `;
        container.appendChild(div);
        extraIndex++;
    }
</script>
@endsection
