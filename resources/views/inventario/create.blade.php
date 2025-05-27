 @extends('dashboard.index')
 <!DOCTYPE html>
 <html lang="es">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <title>Crear Inventario</title>

     <link rel="stylesheet" href="{{ asset('css/inventarioEstilos/createInventario.css') }}">
     <!-- CSS de Select2 -->





 </head>

 <body>
     @section('contenido')

     <h2> CREAR INVENTARIO</h2>

     <div class="container">
         <form action="{{ route('inventario.store') }}" method="POST" enctype="multipart/form-data">
             @csrf
             <div class="form-columns">
                 <!-- Columna 1: Producto, Precio Venta y Precio Compra -->
                 <div class="form-group">
                     <div class="form-header">Precios del Producto</div>
                     <!-- Producto -->
                     <div style="margin-bottom: 20px;">
                         <label for="id_producto">Producto</label>
                         <select name="id_producto" id="id_producto" class="form-control">
                             <option value="">Selecciona un producto</option>
                             @foreach ($productos as $producto)
                             <option
                                 value="{{ $producto->id }}"
                                 data-imagen="{{ $producto->imagen }}"
                                 data-categoria="{{ $producto->categoria->nombre ?? 'Sin categoría' }}">
                                 {{ $producto->nombre }} - {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                             </option>
                             @endforeach
                         </select>
                         @error('id_producto')
                         <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                         @enderror
                     </div>


                     <div class="imagen-actual" id="imagenActualContainer" style="display: none;">
                         <label class="imagen-label">Producto seleccionado</label>
                         <img id="imagenActual"
                             src=""
                             alt="Imagen actual"
                             class="imagen-preview"
                             onclick="openModal(this.src)">
                     </div>



                     <!-- Precio Compra -->

                     <!--    <label for="compra">
                                    <i class="fa-solid fa-money-bill-wave"  style="color:#335dd4 ; "style="margin-right: 5px;"></i> Precio de compra 
                                </label>
                                <input type="number" id="compra" step="0.01" min="0.01" name="compra" placeholder="Precio de compra" value="{{ old('unidad') }}">
                                @error('unidad')
                                    <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                                @enderror-->

                     <!-- Precio por unidad -->
                     <label for="xunidad">
                         <i class="fa-solid fa-tablets" style="color:#335dd4 ; " style="margin-right: 5px;"></i> Precio de venta <span style="color: gray; font-style: italic;">(Por unidad)</span></i>
                     </label>
                     <input type="number" id="xunidad" step="0.01" min="0.01" name="xunidad" placeholder="Precio por unidad" value="{{ old('xunidad') }}">
                     @error('xunidad')
                     <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                     @enderror
                     <!-- Precio por caja -->

                     <label for="xcaja">
                         <i class="fa-solid fa-box-open" style="color: #335dd4 ; " style="margin-right: 5px;"></i>Precio de venta <span style="color: gray; font-style: italic;">(Por caja)</span></i>
                     </label>
                     <input type="number" id="xcaja" step="0.01" min="0.01" name="xcaja" placeholder="Precio por caja" value="{{ old('xcaja') }}">
                     @error('xcaja')
                     <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                     @enderror
                 </div>

                 <!-- Columna 2: Stock y Fecha -->
                 <div class="form-group">
                     <div class="form-header">Información del Producto</div>


                     <!-- Numero de cajas -->
                     <label for="cantidad_caja">Cantidad de cajas</label>
                     <input type="number" id="cantidad_caja" step="0.01" min="0.01" name="cantidad_caja" placeholder="Cantidad de cajas" value="{{ old('cantidad_caja') }}">
                     @error('cantidad_caja')
                     <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                     @enderror

                     <!-- Unidades por caja -->
                     <label for="unidad_caja">Unidades por caja</label>
                     <input type="number" id="unidad_caja" step="0.01" min="0.01" name="unidad_caja" placeholder="Unidades por caja" value="{{ old('unidad_caja') }}">
                     @error('unidad_caja')
                     <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
                     @enderror


                     <!-- Fecha de caducidad  seleccionar despues de la actual-->
                     @php
                     $today = date('Y-m-d');
                     @endphp

                     <!--min en fecha para solo se pueda seleccionar fechas de hoy para adelante-->
                     <label for="caducidad">Fecha de caducidad</label>
                     <input type="date" id="caducidad" name="caducidad"
                         onfocus="this.type='date'"
                         onblur="if(!this.value)this.type='text'"
                         min="{{ date('Y-m-d') }}"
                         placeholder="Selecciona la fecha"
                         value="{{ old('caducidad') }}"
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









     <script>
         flatpickr("#caducidad", {
             minDate: "today",
             dateFormat: "Y-m-d",
             locale: "es"
         });
     </script>



    <script>
    $(document).ready(function () {
        $('#id_producto').select2({
            placeholder: 'Selecciona un producto',
            allowClear: true
        });

        
        $('#id_producto').on('change', function () {
            const selectedOption = $(this).find(':selected');
            const imagen = selectedOption.data('imagen');

            console.log(imagen); 

            if (imagen) {
                $('#imagenActual').attr('src', `/imagenes/${imagen}`);
                $('#imagenActualContainer').show();
            } else {
                $('#imagenActual').attr('src', '');
                $('#imagenActualContainer').hide();
            }
        });
    });
</script>
     <!--Mostrar imagen del producto-->
     <script>
       

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