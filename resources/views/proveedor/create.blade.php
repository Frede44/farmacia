<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Crear proveedor</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/createProductos.css') }}"> 
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    

<link href="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.css" rel="stylesheet" integrity="sha384-7OG4hcSLohnvJO+lbBJjJFRAjv+fviYGllCE2hGpAflRok8nXfvl63MOkYjzqGJm" crossorigin="anonymous">
 
<script src="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.js" integrity="sha384-FFQxq76hs6g5HqAK1+xdA0Xtd3QmeEI7+l9TCXGEhfCcakwq6vPL0ohx5R2dhiOP" crossorigin="anonymous"></script>

</head>



    <body>
    @section('contenido')

    <h2> CREAR PROVEEDOR</h2>
 
                    <div class="container">
                    <form action="{{ route('proveedor.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-columns">
                            <div class="form-group">

                                <!--Nombre del proveedor-->
                                <label for="nombre">Nombre del Proveedor</label>
                                <small id="contadorNombre" style="display: block; color: #666; font-size: 12px; margin-top: 4px;"></small>
                                <input type="text" id="nombre" name="nombre" placeholder="Nombre del proveedor" maxlength="45" value="{{ old('nombre') }}"oninput="actualizarContador('nombre', 'contadorNombre', 50)">
                                @error('nombre')
                                <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror

                                <!--Numero de telefono-->
                                <label for="numero_telefono">Número de Teléfono</label>
                                <input type="text" id="numero_telefono" name="numero_telefono" placeholder="0000-0000" value="{{ old('numero_telefono') }}" maxlength="9">
                                @error('numero_telefono')
                                    <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror
                                <!--Correo-->
                                <label for="correo">Correo Electronico</label>
                                <input type="text" id="correo" name="correo" maxlength="150" placeholder="Correo Electronico" value="{{ old('correo') }}">
                                @error('correo')
                                <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror
                                

                               


                            </div>

                            <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <small id="contador" style="display: block; color: #666; font-size: 12px; margin-top: 4px;"></small>
                                <textarea id="descripcion" name="descripcion" placeholder="Descripción del proveedor..." maxlength="250" oninput="actualizarContador()">{{ old('descripcion') }}</textarea>
                               




                      


                                
                            </div>
                        </div>

                        <div class="grupoBotones">
                            <button type="submit" class="btn-guardar">Guardar</button>
                            <a href="{{ route('proveedor.index') }}?cancelado=1" class="btn-cancelar">Cancelar</a>
                        </div>
                    </form>
                </div>
                <div style="height:50px;"></div>

               




                <script>
document.getElementById('numero_telefono').addEventListener('input', function (e) {
    let value = e.target.value.replace(/\D/g, ''); // Eliminar caracteres no numéricos
    if (value.length > 4) {
        value = value.slice(0, 4) + '-' + value.slice(4);
    }
    e.target.value = value.slice(0, 9); // Limitar a 9 caracteres (8 números + 1 guion)
});
</script>
   
    
    @endsection


    </body>


</html>