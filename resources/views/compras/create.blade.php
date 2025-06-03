@extends('dashboard.index')

@section('contenido')
<link rel="stylesheet" href="{{ asset('css/comprasEstilos/estilos.css') }}">
<link rel="stylesheet" href="styles.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


<h2>CREAR COMPRA</h2>
<!-- JS de jQuery y Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="container">

    <div style="display: flex;">
        <div >
            <div class="form-group">
                <label for="producto">Producto</label>
                <select id="producto" name="producto_id">
                    <option value="">Seleccione un producto</option>
                    @foreach ($productos as $producto)
                    <option  value="{{ $producto->id }}"
                    data-imagen="{{ $producto->imagen }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
                @error('producto_id')
                <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" required>
                @error('cantidad')
                <div class="error">{{ $message }}</div>
                @enderror

            </div>

            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" required>
                @error('precio')
                <div class="error">{{ $message }}</div>
                @enderror

            </div>


        </div>
        <div >
            <div class="form-group">
                <label for="proveedor">Proveedor</label>
                <select id="proveedor" name="proveedor_id">
                    <option value="">Seleccione un proveedor</option>
                    @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                    @endforeach
                </select>
                @error('proveedor_id')
                <div class="error">{{ $message }}</div>
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
             <!-- Modal para mostrar imagen en grande -->
             <div id="imageModal" class="modal-imagen" onclick="closeModal()">
                 <span class="cerrar-modal">&times;</span>
                 <img class="modal-contenido" id="modalImg">
             </div>
        </div>
    </div>

             
    <div class="grupoBotones">
        <button id="btn-agregar" type="button" class="btn-guardar">Agregar</button>
        <a href="{{ route('compras.index') }}?cancelado=1" class="btn-cancelar">Cancelar</a>
    </div>
</div>

<div>
    <div class="titulo-lista">
        <h3 class="text-list">Lista de Compras</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tabla-compras-body"></tbody>
    </table>

    <!-- Aquí se inyectarán los inputs ocultos -->

</div>

<!-- Formulario final para enviar los datos al controlador -->
<div style="display: flex; justify-content: center; align-items: center; margin-top: 20px;">
    <form id="form-compras" action="{{ route('compras.store') }}" method="POST">
    @csrf
    <div id="inputs-ocultos"></div>
    <button type="submit" class="btnAgregarf">Agregar Compra</button>
</form>
</div>

<script>
    const carritoHiddenInputs = document.getElementById('inputs-ocultos');
    const btnAgregar = document.getElementById('btn-agregar');
    const tablaBody = document.getElementById('tabla-compras-body');
    let index = 0;

    btnAgregar.addEventListener('click', function(e) {
        e.preventDefault();

        const proveedor = document.getElementById('proveedor');
        const producto = document.getElementById('producto');
        const cantidad = parseFloat(document.getElementById('cantidad').value);
        const precio = parseFloat(document.getElementById('precio').value);

        if (!proveedor.value || !producto.value || !cantidad || !precio) {
            alert("Por favor, completa todos los campos.");
            return;
        }

        const proveedorID = proveedor.value;
        const productoID = producto.value;
        const proveedorTexto = proveedor.options[proveedor.selectedIndex].text;
        const productoTexto = producto.options[producto.selectedIndex].text;

        // Verificar si ya existe la fila con el mismo proveedor y producto
        const filaExistente = [...tablaBody.querySelectorAll('tr')].find(fila =>
            fila.getAttribute('data-id-proveedor') === proveedorID &&
            fila.getAttribute('data-id-producto') === productoID
        );

        if (filaExistente) {
            // Actualizar cantidad y total en la fila existente
            const celdaCantidad = filaExistente.querySelector('.celda-cantidad');
            const celdaTotal = filaExistente.querySelector('.celda-total');
            let cantidadActual = parseFloat(celdaCantidad.textContent);
            let nuevaCantidad = cantidadActual + cantidad;
            celdaCantidad.textContent = nuevaCantidad;
            celdaTotal.textContent = (nuevaCantidad * precio).toFixed(2);

            // Actualizar input oculto correspondiente
            const dataIndex = filaExistente.getAttribute('data-index');
            const inputCantidad = carritoHiddenInputs.querySelector(`input[name="productos[${dataIndex}][cantidad]"]`);
            const inputPrecio = carritoHiddenInputs.querySelector(`input[name="productos[${dataIndex}][precio]"]`);
            inputCantidad.value = nuevaCantidad;
            inputPrecio.value = precio; // en caso cambie el precio
        } else {
            const filaIndex = index++;

            const fila = document.createElement('tr');
            fila.setAttribute('data-index', filaIndex);
            fila.setAttribute('data-id-proveedor', proveedorID);
            fila.setAttribute('data-id-producto', productoID);
            fila.innerHTML = `
                <td>${proveedorTexto}</td>
                <td>${productoTexto}</td>
                <td class="celda-cantidad" contenteditable="true">${cantidad}</td>
                <td>${precio}</td>
                <td class="celda-total">${(cantidad * precio).toFixed(2)}</td>
                <td><button type="button" class="btn-eliminar"><i class="fa-solid fa-trash"></i></button></td>
            `;
            tablaBody.appendChild(fila);

            carritoHiddenInputs.innerHTML += `
                <input type="hidden" name="productos[${filaIndex}][id_proveedor]" value="${proveedorID}" data-index="${filaIndex}">
                <input type="hidden" name="productos[${filaIndex}][id_producto]" value="${productoID}" data-index="${filaIndex}">
                <input type="hidden" name="productos[${filaIndex}][cantidad]" value="${cantidad}" data-index="${filaIndex}">
                <input type="hidden" name="productos[${filaIndex}][precio]" value="${precio}" data-index="${filaIndex}">
            `;
        }

        document.getElementById('cantidad').value = '';
        document.getElementById('precio').value = '';
    });

    // Eliminar fila
    tablaBody.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-eliminar')) {
            const fila = e.target.closest('tr');
            const index = fila.getAttribute('data-index');
            fila.remove();
            carritoHiddenInputs.querySelectorAll(`input[data-index="${index}"]`).forEach(input => input.remove());
        }
    });

    // Actualizar cantidad y total cuando se edita desde la tabla
    tablaBody.addEventListener('blur', function(e) {
        if (e.target.classList.contains('celda-cantidad')) {
            const fila = e.target.closest('tr');
            const index = fila.getAttribute('data-index');
            const nuevaCantidad = parseFloat(e.target.textContent);

            if (isNaN(nuevaCantidad) || nuevaCantidad <= 0) {
                alert('Cantidad inválida');
                return;
            }

            const precio = parseFloat(fila.children[3].textContent);
            const totalCelda = fila.querySelector('.celda-total');
            totalCelda.textContent = (nuevaCantidad * precio).toFixed(2);

            const inputCantidad = carritoHiddenInputs.querySelector(`input[name="productos[${index}][cantidad]"]`);
            inputCantidad.value = nuevaCantidad;
        }
    }, true);
</script>
 <script>
    $(document).ready(function () {
        $('#producto').select2({
            placeholder: 'Selecciona un producto',
            allowClear: true
        });

        
        $('#producto').on('change', function () {
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