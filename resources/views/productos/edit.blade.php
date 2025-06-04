<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Editar productos</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/editProductos.css') }}"> 
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
     <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">

<link href="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.css" rel="stylesheet" integrity="sha384-7OG4hcSLohnvJO+lbBJjJFRAjv+fviYGllCE2hGpAflRok8nXfvl63MOkYjzqGJm" crossorigin="anonymous">
 
<script src="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.js" integrity="sha384-FFQxq76hs6g5HqAK1+xdA0Xtd3QmeEI7+l9TCXGEhfCcakwq6vPL0ohx5R2dhiOP" crossorigin="anonymous"></script>

</head>



    <body>
    @section('contenido')

<h2>EDITAR PRODUCTO</h2>

<div class="container">
    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-columns">
            <div class="form-group">

                <!-- Código -->
                <label for="codigo">Código</label>
                <input type="text" id="codigo" readonly name="codigo" value="{{ old('codigo', $producto->codigo) }}">
                @error('codigo')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}
                </div>
                @enderror

                <!-- Nombre -->
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre"  value="{{ old('nombre', $producto->nombre) }}" maxlength="50">
                @error('nombre')
                <div class="error-message">
                     <i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}
                </div>
                @enderror

                <!-- Categoría -->
                <label for="categoria_id">Categoría</label>
                <select name="categoria_id" id="categoria_id">
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}
                </div>
                @enderror
               <!-- Imagen actual -->
                <div class="imagen-actual">
                    <label class="imagen-label" style="color: green;">Producto actual</label>
                    @if($producto->imagen)
                        <img src="{{ asset('imagenes/' . $producto->imagen) }}" 
                            alt="Imagen actual" 
                            class="imagen-preview" 
                            onclick="openModal(this.src)">
                    @endif
                </div>
                                

            </div>

            <div class="form-group">
                <!-- Descripción -->
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" maxlength="250">{{ old('descripcion', $producto->descripcion) }}</textarea>
               
            <div class="imagen-contenedor">
               
                

                <!-- Nueva imagen -->
                
                <div class="imagen-nueva">
                    <label class="imagen-label">Imagen nueva</label>
                    <div class="fondoimagen">
                        <label for="imagen" class="upload-text">
                            <i class="fas fa-image"></i>
                            <span id="upload-label-text">Seleccionar imagen</span>
                        </label>
                        <input type="file" id="imagen" name="imagen" accept="image/*" >
                        <img id="previewImg" src="" >
                        @error('imagen')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <!-- Modal para incrementar la imagen-->
                <div id="imageModal" class="modal" onclick="closeModal()">
                    <span class="close">&times;</span>
                    <img class="modal-content" id="modalImg">
                </div>
            </div>
                <!--Fin-->
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
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('imagen');
        const previewImg = document.getElementById('previewImg');

        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                previewImg.src = '';
                previewImg.style.display = 'none';
            }
        });
    });
</script>


<!--incremetar imagen-->
<script>
function openModal(src) {
    const modal = document.getElementById("imageModal");
    const modalImg = document.getElementById("modalImg");
    modal.style.display = "block";
    modalImg.src = src;
}

function closeModal() {
    document.getElementById("imageModal").style.display = "none";
}

// Vista previa de imagen nueva
function previewImage(event) {
    const output = document.getElementById('previewImg');
    output.src = URL.createObjectURL(event.target.files[0]);
}
</script>
   <!--Mensaje cuando se guarda correctamente-->
   @if (session('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
@endif
<!--Mensaje cuando se cancela correctamente-->
@if(request()->has('cancelado'))
<script>
    Swal.fire({
        icon: 'info',
        title: 'Cancelado',
        text: 'La operación fue cancelada correctamente',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: ' #09b410', 
    });
</script>
@endif
@endsection


    </body>
    


</html>