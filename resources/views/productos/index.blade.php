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
         <th>Acciones</th>
      
 
       
         
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


         {{-- Acciones --}}
         <td>
                         <!-- Botón Editar -->
                <div class="flex flex-col justify-center items-center gap-2">
                <form  method="GET">
                        @csrf
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btnEditar" >
                            <i class="fa-regular fa-pen-to-square fa-lg" style="color:rgb(255, 255, 255);"></i>
                        </a>
                    </form>

                    <!-- Botón Eliminar -->
                    <form action="{{route('productos.destroy',$producto->id)}}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <a href="#" class="btnEliminar" onclick="confirmarEliminacion(event, this)">
                            <i class="fa-regular fa-trash-can fa-xl" style="color:rgb(255, 255, 255);"></i>
                        </a>
                    </form>
                </div>
        </td>
     </tr>
     @endforeach

 
     <script>
    function confirmarEliminacion(event, elemento) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡Esta acción no se puede deshacer!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                elemento.closest('form').submit();
            }
        });
    }
</script>
     
     </tbody>
 </table>
 </div>
 <div style="height:1px;"></div>
    </div>


</body>

@endsection

</html>