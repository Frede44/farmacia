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
    <h2>PRODUCTOS</h2>
 
 <a href="{{ route('productos.create') }}">
 <button class="btnAgregar">+Producto</button>
 </a>
 
 <div class="table-container">
 
 
 
 <table id="tablaUsuarios" class="display nowrap" >
     <thead>
     <tr>
         <th>Codigo</th>
         <th class="nombre">Producto</th>
         <th>Descripción</th>
         <th>Categoría</th>
         <th>Precio Venta</th>
         <th>Imagen</th>
      
 
       
         
     </tr>
     </thead>
     <tbody>
     @foreach($productos as $producto)
     <tr>
         <td>{{ $producto->codigo }}</td>
         <td>{{ $producto->nombre }}</td>
         <td>{{ $producto->descripcion }}</td>
         <td>{{ $producto->categoria->nombre }}</td>
         <td>{{ $producto->precio_venta }}</td>
         <td>
             @if($producto->imagen)
             <img src="{{ asset('imagenes/' . $producto->imagen) }}" width="50" height="50" alt="Imagen del producto">
             @else
             Sin Imagen
             @endif
         </td>
     </tr>
     @endforeach

 
     
     <!-- Puedes agregar más filas -->
     </tbody>
 </table>
 </div>
 <div style="height:1px;"></div>
    </div>


</body>

@endsection

</html>