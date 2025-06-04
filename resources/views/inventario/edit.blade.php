<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Crear Inventario</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pestaña.png') }}">
    <link rel="stylesheet" href="{{ asset('css/inventarioEstilos/createInventario.css') }}"> 
     <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">

    
<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

</head>

    <body>
    @section('contenido')

    <h2> INVENTARIO</h2>
 
                    <div class="container">
                    <form action="{{ route('inventario.update', $inventario->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 

                        
                        <div class="form-columns">
                            <!-- Columna 1: Producto, Precio Venta y Precio Compra -->
                            <div class="form-group">
                            <div class="form-header">Precios del Producto</div>
                                <!-- Producto -->
                                <label for="id_producto">Producto</label>
                                <select name="id_producto" id="id_producto" class="form-control">
                                    <option value="">Selecciona un producto</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}" data-imagen="{{ $producto->imagen }}" {{ (old('id_producto', $inventario->id_producto) == $producto->id) ? 'selected' : '' }}>
                                            {{ $producto->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_producto')
                                    <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror
                                
                                 <!-- Imagen dinámica -->
                            <div class="imagen-actual" id="imagenActualContainer" style="display: none;">
                                <label class="imagen-label">Producto seleccionado</label>
                                <img id="imagenActual" 
                                    src="" 
                                    alt="Imagen actual" 
                                    class="imagen-preview" 
                                    onclick="openModal(this.src)">
                            </div>

                                <!-- Precio Compra -->
                               
                               
                                 <!-- Precio por unidad -->
                                 <label for="xunidad">
                                    <i class="fa-solid fa-tablets"  style="color:#335dd4 ; "style="margin-right: 5px;"></i> Precio por Unidad
                                </label>
                                <input type="number" id="xunidad" step="0.01" min="0.01" name="xunidad" placeholder="Precio por unidad" value="{{ old('xunidad', $inventario->xunidad) }}">
                                @error('xunidad')
                                    <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror
                                 <!-- Precio por caja -->
                               
                                <label for="xcaja">
                                    <i class="fa-solid fa-box-open"  style="color: #335dd4 ; "style="margin-right: 5px;"></i> Precio por Caja
                                </label>
                                <input type="number" id="xcaja" step="0.01" min="0.01" name="xcaja" placeholder="Precio por caja" value="{{ old('xcaja', $inventario->xcaja) }}">
                                @error('xcaja')
                                    <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Columna 2: Stock y Fecha -->
                            <div class="form-group">
                            <div class="form-header">Información del Producto</div>


                                <!-- Numero de cajas -->
                                <label for="cantidad_caja">Cantidad de cajas</label>
                                <input type="number" id="cantidad_caja" step="0.01" min="0.01" name="cantidad_caja" placeholder="Cantidad de cajas" value="{{ old('cantidad_caja', $inventario->cantidad_caja) }}">
                                @error('cantidad_caja')
                                    <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror
                                
                                 <!-- Unidades por caja -->
                                 <label for="unidad_caja">Unidades por caja</label>
                                <input type="number" id="unidad_caja" step="0.01" min="0.01" name="unidad_caja" placeholder="Unidades por caja" value="{{ old('unidad_caja', $inventario->cantidad_caja) }}">
                                @error('unidad_caja')
                                    <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror


                                <!-- Fecha de caducidad  seleccionar despues de la actual-->
                                                                @php
                                    $today = date('Y-m-d');
                                @endphp

                                <label for="caducidad">Fecha de caducidad</label>
                                <input type="date" id="caducidad" name="caducidad"
                                    onfocus="this.type='date'"
                                    onblur="if(!this.value)this.type='text'"
                                    placeholder="Selecciona la fecha"
                                    min="{{ date('Y-m-d') }}" 
                                    value="{{ old('caducidad', $inventario->caducidad) }}"
                                    class="form-control fecha-input">
                                @error('caducidad')
                                    <div class="error-message">
                                        <i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}
                                    </div>
                                @enderror

                               
                               
                            </div>
                        </div>
                        
                         <!-- Modal para mostrar imagen en grande -->
                         <div id="imageModal" class="modal-imagen" onclick="closeModal()">
                            <span class="cerrar-modal">&times;</span>
                            <img class="modal-contenido" id="modalImg">
                        </div>





                        <div class="grupoBotones">
                            <button type="submit" class="btn-guardar">Guardar</button>
                            <a href="{{ route('inventario.index') }}?cancelado=1" class="btn-cancelar">Cancelar</a>
                        </div>
                    </form>
                </div>
                <div style="height:50px;"></div>

              

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




<script>
    flatpickr("#caducidad", {
        minDate: "today",
        dateFormat: "Y-m-d",
        locale: "es"
    });
</script>

<!--Mostrar imagen del producto-->
<script>
    const selectProducto = document.getElementById('id_producto');
    const imagenActual = document.getElementById('imagenActual');
    const imagenActualContainer = document.getElementById('imagenActualContainer');

    function mostrarImagenSeleccionada() {
        const selectedOption = selectProducto.options[selectProducto.selectedIndex];
        const imagen = selectedOption.getAttribute('data-imagen');

        if (imagen) {
            imagenActual.src = `/imagenes/${imagen}`; 
            imagenActualContainer.style.display = 'block';
        } else {
            imagenActual.src = '';
            imagenActualContainer.style.display = 'none';
        }
    }

    // Ejecutar al cargar la página
    document.addEventListener('DOMContentLoaded', function () {
        mostrarImagenSeleccionada();
    });

    // Ejecutar al cambiar el producto
    selectProducto.addEventListener('change', mostrarImagenSeleccionada);

    // Modal script
    function openModal(src) {
        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImg");
        modal.style.display = "block";
        modalImg.src = src;
    }
    function closeModal() {
        document.getElementById("imageModal").style.display = "none";
    }
</script>
    
   
    
    @endsection

    </body>


</html>