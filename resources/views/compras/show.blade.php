@extends('dashboard.index')
<title>Compras</title>
<link rel="stylesheet" href="{{ asset('css/comprasEstilos/show.css') }}">
<link rel="icon" type="image/png" href="{{ asset('img/pestaña.png') }}">
<link rel="stylesheet" href="styles.css" />
<script src="script.js"></script>
 <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">


@section('contenido')
<h2>Lista de Compras</h2>
<a href="{{ route('compras.create') }}"style="text-decoration:none;">
    <button class="btnAgregar">+Nueva compra</button>
</a>

<div class="table-container">
    <table id="tablaUsuarios" class="display nowrap">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th> 
                <th>Subtotal</th>
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