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



        <table id="tablaUsuarios" class="display nowrap">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th class="nombre">Producto</th>
                    <th>Categoria</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Precio Compra</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Ana</td>
                    <td>Email</td>
                    <td>28</td>
                    <td>Sí</td>
                    <td>No</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Ana</td>
                    <td>Email</td>
                    <td>28</td>
                    <td>Sí</td>
                    <td>No</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Ana</td>
                    <td>Email</td>
                    <td>28</td>
                    <td>Sí</td>
                    <td>No</td>
                    <td>No</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Ana</td>
                    <td>Email</td>
                    <td>28</td>
                    <td>Sí</td>
                    <td>No</td>
                    <td>No</td>
                </tr>



                <!-- Puedes agregar más filas -->
            </tbody>
        </table>
    </div>


</body>

@endsection

</html>