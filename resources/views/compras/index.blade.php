@extends('dashboard.index')
<title>Compras</title>
<link rel="stylesheet" href="{{ asset('css/comprasEstilos/index.css') }}">

<link rel="stylesheet" href="styles.css" />
<script src="script.js"></script>
 <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">


@section('contenido')
<h2>Lista de Compras</h2>

<div class="btn_div">
    <a href="{{ route('compras.create') }}" style="text-decoration:none;">
        <button class="btnAgregar">+Compra</button>
    </a>
</div>

<div class="table-container">
    <table id="tablaUsuarios" class="display nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
            <tr>
                <td>{{ $compra->id }}</td>

                <td>{{ $compra->fecha }}</td>
                <td>{{ $compra->total }}</td>
                <td>
                    <div class="flex flex-col justify-center items-center gap-2">
                        <form method="GET">
                            @csrf
                            <a href="{{ route('compras.show', $compra->id) }}" class="btnEditar">
                                <i class="fa-solid fa-eye" style="color:rgb(255, 255, 255);"></i>
                            </a>
                        </form>

                        <!-- Botón Eliminar -->
                        <form action="{{route('compras.destroy',$compra->id)}}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <a href="#" class="btnEliminar" onclick="confirmarEliminacion(event, this)">
                                <i class="fa-regular fa-trash-can fa-xl" style="color:rgb(255, 255, 255);"></i>
                            </a>
                        </form>
                    </div>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

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

@endsection