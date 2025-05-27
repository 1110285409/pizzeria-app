@extends('layouts.app')

@section('content')
<h1>Agregar Ingrediente</h1>

<form method="POST" action="{{ route('ingredients.store') }}">
    @csrf
    <label>Nombre:</label>
    <input type="text" name="name" required>
    <button type="submit">Guardar</button>
</form>
@endsection
