<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Editar Presentación</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pestaña.png') }}">
    <link rel="stylesheet" href="{{ asset('css/categoriasEstilos/createCategorias.css') }}"> 
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
     <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">

<link href="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.css" rel="stylesheet" integrity="sha384-7OG4hcSLohnvJO+lbBJjJFRAjv+fviYGllCE2hGpAflRok8nXfvl63MOkYjzqGJm" crossorigin="anonymous">
 
<script src="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.js" integrity="sha384-FFQxq76hs6g5HqAK1+xdA0Xtd3QmeEI7+l9TCXGEhfCcakwq6vPL0ohx5R2dhiOP" crossorigin="anonymous"></script>
</head>



<body>
    @section('contenido')

    <h2> EDITAR PRESENTACIÓN</h2>

    <div class="container">
        <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre de la presentación</label>
                <input type="text" id="nombre" name="nombre" placeholder="Nombre de la presentación" maxlength="50" value="{{ old('nombre', $categoria->nombre) }}" >
                @error('nombre')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" maxlength="250">{{ old('descripcion', $categoria->descripcion) }}</textarea>
            </div>

            <div class="grupoBotones">
                <button type="submit" class="btn-guardar">Guardar</button>
                <a href="{{ route('categorias.index') }}?cancelado=1" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>

    <div style="height:1px;"></div>
</body>
@endsection



</html>