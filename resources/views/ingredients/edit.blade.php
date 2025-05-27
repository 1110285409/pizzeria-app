@extends('layouts.app')

@section('content')
<h1>Editar Ingrediente</h1>

<form method="POST" action="{{ route('ingredients.update', $ingredient) }}">
    @csrf
    @method('PUT')
    <label>Nombre:</label>
    <input type="text" name="name" value="{{ $ingredient->name }}" required>
    <button type="submit">Actualizar</button>
</form>
@endsection
