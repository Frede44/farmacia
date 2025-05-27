<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Ventas</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}">



    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>




</head>



<body>
    @section('contenido')
    <h2>Ventas</h2>

    <div class="btn_div">
        <a href="{{ route('ventas.create') }}">
            <button class="btnAgregar">Crear venta</button>
        </a>
    </div>

    <div class="table-container">



        <table id="tablaUsuarios" class="display nowrap">
            <thead>
                <tr>
                    <th>Numero de venta </th>
                    <th>cliente</th>
                    <th>Usuario </th>
                    <th>total</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>


                </tr>
            </thead>
            <tbody>

                @foreach($ventas as $venta)
                <tr>
                    <td>{{$venta->id}}</td>
                    <td>{{$venta->cliente->nombre}}</td>
                    <td>{{$venta->usuario->name}}</td>
                    <td>{{$venta->total}}</td>
                    <td>{{$venta->estado}}</td>
                    <td>{{$venta->fecha}}</td>
                    <td>
                        <!-- Botón Editar -->
                        <div class="flex flex-col justify-center items-center gap-2">
                            <form method="GET">
                                @csrf
                                <a href="{{ route('ventas.show', $venta->id) }}" class="btnEditar">
                                    <i class="fa-solid fa-eye" style="color:rgb(255, 255, 255);"></i>
                                </a>
                            </form>

                            <!-- Botón Eliminar -->


                            <a href="{{ asset('storage/ticket_venta_'.$venta->id.'.pdf') }}" class="btnEliminar" target="_blank">
                                <i class="fa-solid fa-file-pdf" style="color:rgb(255, 255, 255);"></i>
                            </a>

                        </div>
                    </td>
                </tr>
                @endforeach



                <!-- Puedes agregar más filas -->
            </tbody>
        </table>
    </div>



</body>

@if(session('pdf'))
<script>
    window.onload = () => {
        window.open("{{ session('pdf') }}", "_blank");
    }
</script>
@endif

@endsection

</html>