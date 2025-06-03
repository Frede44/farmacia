<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Crear Presentación</title>
    <link rel="stylesheet" href="{{ asset('css/categoriasEstilos/createCategorias.css') }}"> 
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    

<link href="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.css" rel="stylesheet" integrity="sha384-7OG4hcSLohnvJO+lbBJjJFRAjv+fviYGllCE2hGpAflRok8nXfvl63MOkYjzqGJm" crossorigin="anonymous">
 
<script src="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.js" integrity="sha384-FFQxq76hs6g5HqAK1+xdA0Xtd3QmeEI7+l9TCXGEhfCcakwq6vPL0ohx5R2dhiOP" crossorigin="anonymous"></script>
</head>



    <body>
    @section('contenido')

    <h2> CREAR PRESENTACIÓN</h2>
 
            <div class="container">
            <form action="{{ route('categorias.store') }}" method="POST">
            @csrf
                <div class="form-group">
                
                    <label for="nombre">Nombre de la presentación</label>
                    <small id="contadorNombre" style="display: block; color: #666; font-size: 12px; margin-top: 4px;"></small>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre de la presentación" maxlength="50"  oninput="actualizarContador('nombre', 'contadorNombre', 50)">
                    @error('nombre')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}
                </div>
                @enderror
                </div>

                <div class="form-group">
                    <small id="contador" style="display: block; color: #666; font-size: 12px; margin-top: 4px;"></small>
                 <textarea id="descripcion" name="descripcion" placeholder="Descripción de la presentación..." maxlength="250"  oninput="actualizarContador()">{{ old('descripcion') }}</textarea>
                 @error('descripcion')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}
                </div>
                @enderror
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