<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Productos</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}"> 
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   


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
    

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- Inicialización -->
    <script>
        $(document).ready(function () {
        $('#tablaUsuarios').DataTable({
            dom: 'Bfrtip',
//Botones de acciones de la tabla
                        buttons: [
                {
                    extend: 'copyHtml5',
                     text: '<i class="fas fa-copy"></i> Copiar'
                },
                {
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"></i> Excel'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<i class="fas fa-file-pdf"></i> PDF'
                },
               
            ],
            
            pageLength: 6,  // Fija la cantidad de registros a  mostrar
            lengthMenu: [5, 10, 25, 50, 100],
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json',
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                paginate: {
                    previous: "Anterior",
                    next: "Siguiente"
                },
                zeroRecords: "No se encontraron resultados",
                buttons: {
                    copyTitle: 'Copiado al portapapeles',
                    copySuccess: {
                        _: '%d filas copiadas',
                        1: '1 fila copiada'
                    }
                }
            }
           
        });
                  
            });
    </script>
<!--Mensaje cuando se guarda correctamente-->
@if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
@endif
<!--Mensaje cuando se cancela correctamente-->
@if(request()->has('cancelado'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Cancelado',
        text: 'La operación fue cancelada correctamente',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: ' #09b410', 
    });
</script>
@endif
    </body>

    @endsection
    </html>