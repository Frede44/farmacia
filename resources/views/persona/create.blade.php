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

    <form action="{{ route('persona.store') }}" method="POST" class="formulario">
        
        @csrf
      <label for="nombre"></label>
      <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>

        <label for="dpi"></label>
        <input type="text" name="dpi" id="dpi" placeholder="DPI" required>

        <label for="correo"></label>
        <input type="email" name="correo" id="correo" placeholder="Correo" required>

        <label for="telefono"></label>
        <input type="text" name="telefono" id="telefono" placeholder="Telefono" required>

        <label for="direccion"></label>
        <input type="text" name="direccion" id="direccion" placeholder="Direccion" required>

        <button type="submit">crear</button>

    </form>
    

    
    </body>

    @endsection
    </html>