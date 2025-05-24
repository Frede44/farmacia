@extends('dashboard.index')

@section('contenido')
<link rel="stylesheet" href="{{ asset('css/comprasEstilos/estilos.css') }}">
<link rel="stylesheet" href="styles.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<h2>CREAR COMPRA</h2>

<div class="container">

    <div style="display: flex;">
        <div >
            <div class="form-group">
                <label for="producto">Producto</label>
                <select id="producto" name="producto_id">
                    <option value="">Seleccione un producto</option>
                    @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" id="cantidad" name="cantidad" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" required>
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
            </div>
        </div>
    </div>

    <div class="grupoBotones">
        <button id="btn-agregar" type="button" class="btn-guardar">Agregar</button>
        <a href="{{ route('compras.index') }}?cancelado=1" class="btn-cancelar">Cancelar</a>
    </div>
</div>

<div>
    <h3>Lista de Compras</h3>
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
<form id="form-compras" action="{{ route('compras.store') }}" method="POST">
    @csrf
    <div id="inputs-ocultos"></div>
    <button type="submit" class="btnAgregarf">Agregar Compra</button>
</form>

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
     

        if (!proveedor.value || !producto.value || !cantidad || !precio ) {
            alert("Por favor, completa todos los campos.");
            return;
        }

        const total = cantidad * precio;
        const filaIndex = index++;

        // Agregar fila a la tabla
        const fila = document.createElement('tr');
        fila.setAttribute('data-index', filaIndex);
        fila.innerHTML = `
        <td>${proveedor.options[proveedor.selectedIndex].text}</td>
        <td>${producto.options[producto.selectedIndex].text}</td>
        <td>${cantidad}</td>
        <td>${precio}</td>
        <td>${total}</td>
        <td><button type="button" class="btn-eliminar">❌</button></td>
    `;
        tablaBody.appendChild(fila);

        // Crear inputs ocultos con estructura tipo array asociativo
        carritoHiddenInputs.innerHTML += `
        <input type="hidden" name="productos[${filaIndex}][id_proveedor]" value="${proveedor.value}" data-index="${filaIndex}">
        <input type="hidden" name="productos[${filaIndex}][id_producto]" value="${producto.value}" data-index="${filaIndex}">
        <input type="hidden" name="productos[${filaIndex}][cantidad]" value="${cantidad}" data-index="${filaIndex}">
        <input type="hidden" name="productos[${filaIndex}][precio]" value="${precio}" data-index="${filaIndex}">
      
    `;

        // Limpiar campos
        document.getElementById('cantidad').value = '';
        document.getElementById('precio').value = '';
    });

    tablaBody.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-eliminar')) {
            const fila = e.target.closest('tr');
            const index = fila.getAttribute('data-index');
            fila.remove();

            // Eliminar inputs ocultos relacionados
            carritoHiddenInputs.querySelectorAll(`input[data-index="${index}"]`).forEach(input => input.remove());
        }
    });
</script>
@endsection