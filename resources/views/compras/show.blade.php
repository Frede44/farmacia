@extends('dashboard.index')
<title>compras</title>
<link rel="stylesheet" href="{{ asset('css/comprasEstilos/show.css') }}">

<link rel="stylesheet" href="styles.css" />
<script src="script.js"></script>
 <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">


@section('contenido')
<h2>Lista de Compras</h2>
<a href="{{ route('compras.create') }}">
    <button class="btnAgregar">Crear nueva compra</button>
</a>

<div class="table-container">
    <table id="tablaUsuarios" class="display nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>producto</th>
                <th>cantidad</th>
                <th>precio</th> 
                <th>subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $detalle)
            <tr>
                <td>{{ $detalle->id }}</td>
                <td>{{ $detalle->producto->nombre }}</td>
                <td>{{ $detalle->cantidad }}</td>
                <td>{{ $detalle->precio }}</td>
                <td>{{ $detalle->subtotal }}</td>
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