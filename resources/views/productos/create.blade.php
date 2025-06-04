<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Crear productos</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pestaña.png') }}">
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/createProductos.css') }}"> 
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
     <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">

<link href="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.css" rel="stylesheet" integrity="sha384-7OG4hcSLohnvJO+lbBJjJFRAjv+fviYGllCE2hGpAflRok8nXfvl63MOkYjzqGJm" crossorigin="anonymous">
 
<script src="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.js" integrity="sha384-FFQxq76hs6g5HqAK1+xdA0Xtd3QmeEI7+l9TCXGEhfCcakwq6vPL0ohx5R2dhiOP" crossorigin="anonymous"></script>

</head>



    <body>
    @section('contenido')

    <h2> CREAR PRODUCTOS</h2>
 
                    <div class="container">
                    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-columns">
                            <div class="form-group">

                                <!--Codigo del producto-->
                                <label for="codigo">Código</label>
                                <input type="text" id="codigo" name="codigo" placeholder="Código" value="{{ old('codigo', $nuevoCodigo) }}" readonly>
                                @error('codigo')
                                <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror

                                <!--Nombre del producto-->
                                <label for="producto">Producto</label>
                                <small id="contadorNombre" style="display: block; color: #666; font-size: 12px; margin-top: 4px;"></small>
                                <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto" maxlength="50" value="{{ old('nombre') }}" oninput="actualizarContador('nombre', 'contadorNombre', 50)">
                                @error('nombre')
                                <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror

                            

                                <!--Categoria del producto-->
                                <label for="categoria_id">Categoría</label>
                                <select name="categoria_id">
                                <option value="">Selecciona una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" >
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                                @error('categoria_id')
                                    <div role="alert" class="alert alert-error mt-4 p-2">
                                    <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                    </div>
                                @enderror


                            </div>

                            <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <small id="contador" style="display: block; color: #666; font-size: 12px; margin-top: 4px;"></small>
                            <textarea id="descripcion" name="descripcion" placeholder="Descripción del producto..." maxlength="250" oninput="actualizarContador()">{{ old('descripcion') }}</textarea>
                               




                                <label for="descripcion">Selecciona una imagen</label>
                                <div class="fondoimagen">
                                
                                <label for="imagen" class="upload-text">
                                    <i class="fas fa-image"></i>
                                    <span id="upload-label-text">Imagen del producto</span>
                                </label>

                                <input type="file" id="imagen" name="imagen" accept="image/*" >
                                <img id="previewImg" src="" alt="Vista previa" style="display: none;" />

                                @error('imagen')
                                <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror
                                
                                </div>


                                
                            </div>
                        </div>

                        <div class="grupoBotones">
                            <button type="submit" class="btn-guardar">Guardar</button>
                            <a href="{{ route('productos.index') }}?cancelado=1" class="btn-cancelar">Cancelar</a>
                        </div>
                    </form>
                </div>
                <div style="height:50px;"></div>

                <script>
  const input = document.getElementById('imagen');
  const previewImg = document.getElementById('previewImg');
  const uploadText = document.querySelector('.upload-text');
  const labelText = document.getElementById('upload-label-text');

  input.addEventListener('change', function () {
    const file = this.files[0];
    if (file && file.type.startsWith('image/')) {
      const reader = new FileReader();

      reader.onload = function (e) {
        previewImg.src = e.target.result;
        previewImg.style.display = 'block';
        uploadText.style.opacity = '1';
        labelText.textContent = 'Clic para remplazar'; // Cambia el texto
      };

      reader.readAsDataURL(file);
    } else {
      previewImg.src = '';
      previewImg.style.display = 'none';
      uploadText.style.opacity = '1';
      labelText.textContent = 'Sube tu imagen'; // Restaura texto si no es imagen
    }
  });
</script>




    
   
    
    @endsection


    </body>


</html>