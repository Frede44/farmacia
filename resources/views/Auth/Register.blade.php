<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/registroEstilos/estilos.css') }}">
</head>
@section('contenido')

<div class="container">
    <h2>Registrar Usuario</h2>
    <form action="{{ route('register.store') }}" method="POST">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" required><br><br>
        @error('name')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror


        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        @error('email')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        @error('password')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror

        <label for="rol">Rol:</label>
        <select name="rol" id="rol">
            <option value="">Seleccione un rol</option>
        
           @foreach ($roles as $rol)
                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
            @endforeach
        </select>
        @error('rol')
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror

        <button type="submit">Registrar</button>
    </form>
</div>
@endsection

</html>