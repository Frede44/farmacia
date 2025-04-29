<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Vista productos</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/createProductos.css') }}"> 
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
@section('contenido')


<body>

    <div class="content">
        
        <h1>Crear Productos</h1>

        <div class="txtAreas" >
            <input type="text" name="nombreProducto" class="">
        </div>
    </div>

   

        

       

       
        

    @endsection
    

</body>


</html>