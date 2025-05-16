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

    <a href="{{ route('ventas.create') }}">
        <button class="btnAgregar">Crear venta</button>
    </a>

    <div class="table-container">



        <table id="tablaUsuarios" class="display nowrap">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>nombre</th>
                    <th>correo</th>
                    <th>roles</th>


                </tr>
            </thead>
            <tbody>
              




                    <!-- Puedes agregar más filas -->
            </tbody>
        </table>
    </div>


 
</body>

@endsection

</html>