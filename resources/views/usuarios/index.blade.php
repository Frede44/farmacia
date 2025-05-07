<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}">
  


    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>




</head>



<body>
    @section('contenido')
    <h2>USUARIOS</h2>

    <a href="{{ route('register.index') }}">
        <button class="btnAgregar">Agregar Usuario</button>
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
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>

                    <td>
                        @foreach ($user->roles as $role)
                        {{ $role->name }}
                        @endforeach
                    </td>


                    @endforeach




                    <!-- Puedes agregar más filas -->
            </tbody>
        </table>
    </div>


 
</body>

@endsection

</html>