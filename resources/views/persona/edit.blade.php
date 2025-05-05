<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Productos</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}"> 
   


    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>

   


    </head>



    <body>
    @section('contenido')
    <h2>Crear productos</h2>

    <form action="{{ route('persona.update', $persona->id) }}" method="POST" class="formulario">
        @csrf

        @method('PUT')
      <label for="nombre"></label>
      <input type="text" name="nombre" id="nombre" placeholder="Nombre" required value="{{ $persona->nombre }}">

        <label for="dpi"></label>
        <input type="text" name="dpi" id="dpi" placeholder="DPI" required value="{{ $persona->dpi }}">

        <label for="correo"></label>
        <input type="email" name="correo" id="correo" placeholder="Correo" required value="{{ $persona->correo }}">   >

        <label for="telefono"></label>
        <input type="text" name="telefono" id="telefono" placeholder="Telefono" required value="{{ $persona->telefono }}">

        <label for="direccion"></label>
        <input type="text" name="direccion" id="direccion" placeholder="Direccion" required value="{{ $persona->direccion }}">

        <button type="submit">Actualizar</button>

    </form>
    

    
    </body>

    @endsection
    </html>