<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index') {{-- Asegúrate que esta ruta sea correcta para tu layout --}}
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/registroEstilos/estilos.css') }}"> {{-- Reutilizamos los mismos estilos --}}
</head>

@section('contenido')
<h2>Editar Usuario</h2>

<div class="container">
    {{-- Es importante mostrar errores de validación si los hay --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('usuarios.update', $user->id) }}" method="POST"> {{-- Ajusta 'users.update' al nombre de tu ruta de actualización --}}
        @csrf
        @method('PUT')

        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required><br><br>
        @error('name') {{-- Muestra error específico para el campo nombre --}}
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required><br><br>
        @error('email') {{-- Muestra error específico para el campo email --}}
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror

        <label for="password">Nueva Contraseña </label>
        <input type="password" id="password" name="password">
        @error('password') {{-- Muestra error específico para el campo contraseña --}}
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror


        <label for="rol">Rol:</label>
        <select name="rol" id="rol" required> {{-- Añadido 'required' si el rol siempre debe estar seleccionado --}}
            <option value="">Seleccione un rol</option>
            @foreach ($roles as $rol)
            <option value="{{ $rol->id }}" {{ (old('rol', $user->rol_id ?? ($user->roles->first()->id ?? '')) == $rol->id) ? 'selected' : '' }}>
                {{ $rol->name }}
            </option>
            @endforeach
        </select>
        @error('rol') {{-- Muestra error específico para el campo rol --}}
        <div class="alert alert-danger mt-1">{{ $message }}</div>
        @enderror
        <br><br>

        <button type="submit">Actualizar Usuario</button>
    </form>
</div>
@endsection

</html>