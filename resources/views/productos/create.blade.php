<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Crear productos</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/createProductos.css') }}"> 
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    

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
                                <input type="text" id="codigo" name="codigo" placeholder="Código">
                                @error('codigo')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <!--Nombre del producto-->
                                <label for="producto">Producto</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto">

                                <!--P del producto-->
                                <label for="precio_venta">Precio venta</label>
                                <input type="number" id="precio_venta" name="precio_venta" placeholder="Precio de venta">
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" name="descripcion" placeholder="Descripción del producto..."></textarea>




                                <label for="descripcion">Selecciona una imagen</label>
                                <div class="fondoimagen">
                                
                                <label for="imagen" class="upload-text">
                                    <i class="fas fa-image"></i>
                                    <span id="upload-label-text">Imagen del producto</span>
                                </label>

                                <input type="file" id="imagen" name="imagen" accept="image/*">
                                <img id="previewImg" src="" alt="Vista previa" style="display: none;" />

                                @error('imagen')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                </div>


                                
                            </div>
                        </div>

                        <div class="grupoBotones">
                            <button type="submit" class="btn-guardar">Guardar</button>
                            <a href="#" class="btn-cancelar">Cancelar</a>
                        </div>
                    </form>
                </div>

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