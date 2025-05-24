@extends('dashboard.index')
<title>compras</title>
<link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}">

<link rel="stylesheet" href="styles.css" />
<script src="script.js"></script>



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
                        <a href="{{ route('compras.show', $compra) }}" class="btn btn-info">Ver</a>
                        
                        <form action="{{ route('compras.destroy', $compra) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection