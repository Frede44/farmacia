<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Ventas</title>
    <link rel="stylesheet" href="{{ asset('css/ventasEstilos/show.css') }}">
  


    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>




</head>



<body>
    @section('contenido')
    <h2>Detalles Venta</h2>


    <div class="table-container">



        <table id="tablaUsuarios" class="display nowrap">
            <thead>
                <tr>
                    <th>ID </th>
                    <th>Venta</th>
                    <th>Producto </th>
                    <th>Tipo</th>
                    <th>cantidad</th>
                    <th>Precio unitario</th>
                    <th>total</th>


                </tr>
            </thead>
            <tbody>
              
                 @foreach($detalles as $detalle)
                   <tr>
                     <td>{{$detalle->id}}</td>
                     <td>{{$detalle->venta_id}}</td>
                     <td>{{$detalle->producto->nombre}}</td>
                     <td>{{$detalle->tipo_venta}}</td>
                     <td>{{$detalle->cantidad}}</td>
                     <td>{{$detalle->precio_unitario}}</td>
                     <td>{{$detalle->subtotal}}</td>
                     
                   </tr>
                 @endforeach



                    <!-- Puedes agregar más filas -->
            </tbody>
        </table>
    </div>


 
</body>

@endsection

</html>