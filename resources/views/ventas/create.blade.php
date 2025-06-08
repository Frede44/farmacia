<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pestaña.png') }}">
    <link rel="stylesheet" href="{{ asset('css/ventasEstilos/ventasEstilos.css') }}">
    <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"

        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        /* Estilos adicionales para la búsqueda de clientes */
        .cliente.seleccionado {
            background-color: #f0f0f0;
            /* Cambia el color de fondo para indicar selección */
            font-weight: bold;
        }
    </style>
</head>
@extends('dashboard.index')
@section('contenido')

@if ($errors->has('error'))
<div class="custom-alert alert alert-danger">
    {{ $errors->first('error') }}
</div>
@endif

<div class="container">
    <div class="productos">
        <div class="search">
            <div class="search-bar">
                <label for="nombre" class="visually-hidden">Buscar producto</label>
                <input type="text" id="nombre" placeholder="Buscar producto">
            </div>
            <select name="ordenar" id="ordenar" class="search-select">
                <option value="">Ordenar por</option>
                <option value="precio-menor">Menor precio</option>
                <option value="precio-mayor">Mayor precio</option>
                <option value="nombre-az">Nombre A-Z</option>
                <option value="nombre-za">Nombre Z-A</option>
            </select>
        </div>

        <div class="container-productos">
            @foreach($productosInventario as $inventario)
            <div class="producto"
                data-id-producto="{{ $inventario->producto->id }}" {{-- <--- NUEVO --}}
                data-nombre="{{ $inventario->producto->nombre }}"
                data-precio-unidad="{{ $inventario->xunidad }}" {{-- <--- CAMBIADO/RENOMBRADO --}}
                data-precio-caja="{{ $inventario->xcaja ?? ($inventario->xunidad * 10) }}" {{-- <--- NUEVO (asume xcaja existe, o calcula un fallback) --}}
                data-stock="{{ $inventario->total_unidad }}"> {{-- <--- AÑADIDO PARA CLARIDAD, aunque ya lo usas para estilo --}}
                <img src="{{ asset('imagenes/' . $inventario->producto->imagen) }}"
                    alt="{{$inventario->producto->nombre}}">
                <div class="producto-info" style="display: flex; flex-direction: row; justify-content: space-between; width: 100%; padding-bottom: 10px;">
                    {{-- Usar data attributes para almacenar información del producto --}}
                    {{-- Usar el operador de fusión null para evitar errores si la categoría no existe --}}
                    <div>
                        <h4 class="categoria">{{ $inventario->producto->categoria->nombre ?? 'Medicina' }}</h4>
                        <h3>{{ $inventario->producto->nombre }}</h3>
                    </div>
                    <div class="fecha-caducidad" style="display: flex; flex-direction: column; align-items: flex-end; width: 100%; justify-content: flex-end; margin-right: 10px;">
                        {{-- Mostrar la fecha de ingreso --}}
                        {{-- Mostrar la fecha de caducidad y los días restantes --}}
                        <span style="font-weight: bold;">Caducidad: </span>
                        <span>{{ $inventario->fechaCaducidadObj->format('d/m/Y') }}</span>
                    </div>
                </div>
                <p>{{$inventario->producto->descripcion}}</p>
                <div class="precio-stock">
                    {{-- Mostrar ambos precios podría ser útil para el usuario --}}
                    <span class="precio">Unidad: Q{{number_format($inventario->xunidad, 2)}}</span>
                    @if(isset($inventario->xcaja) && $inventario->xcaja > 0)
                    <span class="precio">Caja: Q{{number_format($inventario->xcaja, 2)}}</span>
                    @endif
                    <span class="stock">Stock: {{$inventario->total_unidad}} unidades</span>
                </div>
                <div class="div-btn">
                    <button class="agregar-unidad">Agregar unidad</button>
                    <button class="agregar-caja" @if(!isset($inventario->xcaja) || $inventario->xcaja <= 0) disabled title="Precio por caja no definido" @endif>Agregar caja</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="container-carrito">
        <div class="carito-titulo">
            <h3 class="activo" id="btnCarrito">Carrito</h3>
            <h3 id="btninfo">Cliente</h3>
        </div>
        {{-- ESTE FORMULARIO ENVIARÁ TODO --}}
        <form id="ventaForm" method="POST" action="{{ route('ventas.store') }}">
            @csrf {{-- Token CSRF de Laravel --}}

            <div class="carrito-productos">
                <h3>Carrito de compras</h3>
                <table id="tabla-carrito">
                    <thead id="carrito-thead" style="display: none;">
                        <tr>
                            <th>Producto</th>
                            <th>Tipo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="carrito-vacio">
                            <td colspan="6" style="text-align: center; padding: 20px;">El carrito está vacío. Agregue
                                productos.
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>



            <div class="contenido-informacion" style="display: none;">
                {{-- Oculto inicialmente por JS --}}
                <h3>Información del cliente</h3>

                <div class="info_cliente_inputs">
                    {{-- Renombrada clase para evitar conflicto --}}
                    <label for="nombre_cliente">Buscar Cliente:</label>
                    <input type="text" id="nombre_cliente" name="cliente[nombre]" placeholder="Nombre o ID del cliente"
                        required>
                </div>

                <div class="cliente_ya_registrado">
                    <p>Clientes registrados</p>
                    <div class="lista_clientes">
                        @foreach($personas as $persona)
                        <div class="cliente" data-nombre="{{ $persona->nombre }}" data-dpi="{{ $persona->id }}"
                            data-telefono="{{ $persona->telefono }}">
                            <p class="nombre">{{ $persona->nombre }}</p>
                            <div class="info_cliente_item">
                                {{-- Renombrada clase para evitar conflicto --}}
                                <div class="dpi_cliente">ID: <span>{{ $persona->id }}</span></div>
                                <div class="tel_cliente"><span>Tel: {{ $persona->telefono }}</span></div>

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- DIV PARA INPUTS OCULTOS DEL CARRITO --}}
            <div id="carrito-hidden-inputs"></div>

            <div class="total">
                <h3 class="titulo_total">Resumen de venta</h3>
                <div class="info_clienteR" style="display: none;"></div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin: 10px;">
                    <p>Subtotal:</p>
                    <span class="subtotal">Q0.00</span> {{-- Cambiado de $ a Q --}}
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin: 10px;">
                    <p>Total:</p>
                    <span id="total">Q0.00</span> {{-- Cambiado de $ a Q --}}
                </div>
            </div>

            {{-- El botón "Comprar" ahora es de tipo submit y está DENTRO del form --}}
            <button type="submit" id="comprar">Comprar</button>
        </form> {{-- Fin de ventaForm --}}

    </div>
</div>

<script>
    const carritoTabla = document.getElementById('tabla-carrito');
    const totalDisplay = document.getElementById('total');
    const subtotalDisplay = document.querySelector('.subtotal');
    const carritoHiddenInputs = document.getElementById('carrito-hidden-inputs');
    const thead = document.getElementById('carrito-thead');
    const productosContainer = document.querySelector('.container-productos');


    let carrito = [];

    const actualizarTablaCarrito = () => {
        carritoTabla.innerHTML = '';
        carritoHiddenInputs.innerHTML = '';

        if (carrito.length === 0) {
            carritoTabla.innerHTML = `
                        <tr id="carrito-vacio">
                            <td colspan="6">El carrito está vacío. Agregue productos.</td>
                        </tr>`;
            totalDisplay.textContent = "Q0.00";
            subtotalDisplay.textContent = "Q0.00";
            thead.style.display = 'none';
            return;
        }

        thead.style.display = '';
        let total = 0;

        carrito.forEach((item, index) => {
            const subtotal = item.precio * item.cantidad;
            total += subtotal;

            const fila = document.createElement('tr');
            // La visualización de la tabla no necesita cambiar drásticamente
            fila.innerHTML = `
            <td>${item.nombre}</td>
            <td>${item.tipo}</td>
            <td>Q${item.precio.toFixed(2)}</td>
            <td>
                <input type="number" min="1" value="${item.cantidad}" data-index="${index}" class="cambiar-cantidad">
            </td>
            <td>Q${subtotal.toFixed(2)}</td>
            <td>
                <button type="button" data-index="${index}" class="eliminar-producto"><i class="fa-regular fa-trash-can"></i></button>
            </td>
        `;
            carritoTabla.appendChild(fila);

            // Crear inputs ocultos para el formulario
            // ASEGÚRATE DE QUE EL NOMBRE DEL CAMPO COINCIDA CON LO QUE ESPERA TU CONTROLADOR EN LARAVEL
            carritoHiddenInputs.innerHTML += `
            <input type="hidden" name="productos[${index}][id_producto]" value="${item.idProducto}"> {{-- <--- NUEVO --}}
            <input type="hidden" name="productos[${index}][nombre]" value="${item.nombre}">
            <input type="hidden" name="productos[${index}][tipo]" value="${item.tipo}">
            <input type="hidden" name="productos[${index}][precio]" value="${item.precio}">
            <input type="hidden" name="productos[${index}][cantidad]" value="${item.cantidad}">
        `;
        });

        totalDisplay.textContent = `Q${total.toFixed(2)}`;
        subtotalDisplay.textContent = `Q${total.toFixed(2)}`;
    };



    productosContainer.addEventListener('click', (event) => {
        const target = event.target;
        if (target.classList.contains('agregar-unidad') || target.classList.contains('agregar-caja')) {
            const productoDiv = target.closest('.producto');
            if (!productoDiv) return;

            // Leer todos los data attributes necesarios
            const idProducto = productoDiv.dataset.idProducto; // <--- NUEVO
            const nombre = productoDiv.dataset.nombre;
            const precioUnidad = parseFloat(productoDiv.dataset.precioUnidad);
            const precioCaja = parseFloat(productoDiv.dataset.precioCaja);
            // const stockDisponible = parseInt(productoDiv.dataset.stock); // Para validaciones futuras si quieres

            const esUnidad = target.classList.contains('agregar-unidad');
            const tipo = esUnidad ? 'Unidad' : 'Caja';
            const precioSeleccionado = esUnidad ? precioUnidad : precioCaja;
            const cantidadAgregada = 1; // Cuando agregamos, agregamos 1 unidad o 1 caja

            // Validar si el precio de caja es válido antes de agregar
            if (!esUnidad && (isNaN(precioCaja) || precioCaja <= 0)) {
                alert('El precio por caja no está disponible para este producto.');
                return;
            }

            //comprobar si no agrega mas producto del que hay en stock



            const existenteIndex = carrito.findIndex(item => item.idProducto === idProducto && item.tipo === tipo);

            if (existenteIndex !== -1) {
                carrito[existenteIndex].cantidad += cantidadAgregada;
            } else {
                carrito.push({
                    idProducto: idProducto, // <--- AÑADIDO
                    nombre: nombre,
                    tipo: tipo,
                    precio: precioSeleccionado, // Este será precioUnidad o precioCaja
                    cantidad: cantidadAgregada // Siempre 1 al añadir una nueva línea de este tipo
                });
            }
            actualizarTablaCarrito();
        }
    });


    carritoTabla.addEventListener('click', (e) => {
        if (e.target.classList.contains('eliminar-producto') || e.target.closest('.eliminar-producto')) {
            const index = parseInt(e.target.dataset.index || e.target.closest('button').dataset.index);
            carrito.splice(index, 1);
            actualizarTablaCarrito();
        }
    });

    carritoTabla.addEventListener('input', (e) => {
        if (e.target.classList.contains('cambiar-cantidad')) {
            const index = parseInt(e.target.dataset.index);
            const nuevaCantidad = parseInt(e.target.value);
            if (nuevaCantidad > 0) {
                carrito[index].cantidad = nuevaCantidad;
                actualizarTablaCarrito();
            }
        }
    });


    document.addEventListener("DOMContentLoaded", () => {
        const stockElements = document.querySelectorAll('.stock');
        stockElements.forEach(el => {
            const match = el.textContent.match(/\d+/);
            const stockValue = match ? parseInt(match[0]) : 0;
            if (!isNaN(stockValue)) {
                el.style.color = stockValue > 50 ? 'green' : 'red';
                el.style.fontWeight = 'bold';
            }
        });

        const carritoBtn = document.getElementById('btnCarrito');
        const infoBtn = document.getElementById('btninfo');
        const contenidoCarritoDiv = document.querySelector('.carrito-productos');
        const contenidoInfoDiv = document.querySelector('.contenido-informacion');
        const infoInputs = document.querySelector('.info_cliente_inputs');
        const resumenInfo = document.querySelector(".info_clienteR")
        const nombreClienteInput = document.getElementById('nombre_cliente'); // Obtener el input de nombre del cliente
        const listaClientesDiv = document.querySelector('.lista_clientes'); // Obtener el div que contiene la lista de clientes
        let clientesRegistrados = []; // Array para almacenar los clientes registrados


        // Inicializa las vistas de carrito e información de cliente
        carritoBtn.addEventListener('click', () => {
            carritoBtn.classList.add('activo');
            infoBtn.classList.remove('activo');
            contenidoCarritoDiv.style.display = 'block';
            contenidoInfoDiv.style.display = 'none';
        });

        infoBtn.addEventListener('click', () => {
            infoBtn.classList.add('activo');
            carritoBtn.classList.remove('activo');
            contenidoCarritoDiv.style.display = 'none';
            contenidoInfoDiv.style.display = 'block';
        });

        // Mostrar carrito por defecto
        carritoBtn.click();


        // Obtener la lista de clientes registrados al cargar la página
        const clienteDivs = document.querySelectorAll('.cliente');
        clienteDivs.forEach(clienteDiv => {
            clientesRegistrados.push({
                nombre: clienteDiv.dataset.nombre,
                dpi: clienteDiv.dataset.dpi,
                telefono: clienteDiv.dataset.telefono
            });
        });

        let clienteSeleccionado = null; // Variable para almacenar el cliente seleccionado

        // Lógica para el llenado de información del cliente
        listaClientesDiv.addEventListener('click', (event) => { // Cambiado a listaClientesDiv
            const target = event.target.closest('.cliente'); // Encuentra el .cliente más cercano
            if (target) {
                const nombre = target.dataset.nombre;
                const dpi = target.dataset.dpi;
                const telefono = target.dataset.telefono;

                // Rellenar el input de nombre
                nombreClienteInput.value = nombre;


                // Actualizar resumen
                resumenInfo.innerHTML = `
                    <p class="nombreResumen">Nombre: ${nombre}</p>
                    <p class="ResumenA">ID: ${dpi}</p>
                    <p class="ResumenA" >Teléfono: ${telefono}</p>
                `;

                infoInputs.innerHTML = `<input type="hidden" name="id_cliente" value="${dpi}">`;
                resumenInfo.style.display = 'block';



                // Remover la clase 'seleccionado' de cualquier otro cliente seleccionado previamente
                if (clienteSeleccionado) {
                    clienteSeleccionado.classList.remove('seleccionado');
                }
                // Agregar la clase 'seleccionado' al cliente actual
                target.classList.add('seleccionado');
                clienteSeleccionado = target; // Actualizar la variable de cliente seleccionado

            }
        });

        // Lógica para la búsqueda de clientes por nombre o DPI
        nombreClienteInput.addEventListener('input', () => {
            const searchTerm = nombreClienteInput.value.toLowerCase().trim();

            clienteDivs.forEach(clienteDiv => {
                const nombre = clienteDiv.dataset.nombre.toLowerCase();
                const dpi = clienteDiv.dataset.dpi.toLowerCase();

                if (nombre.includes(searchTerm) || dpi.includes(searchTerm)) {
                    clienteDiv.style.display = ''; // Mostrar cliente
                } else {
                    clienteDiv.style.display = 'none'; // Ocultar cliente
                }
            });
            resumenInfo.style.display = 'none';

        });


        // --- INICIO: CÓDIGO PARA EL BUSCADOR DE PRODUCTOS ---
        const searchInput = document.getElementById('nombre');
        const allProducts = Array.from(document.querySelectorAll('.producto'));

        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();

            allProducts.forEach(productoDiv => {
                const productNameElement = productoDiv.querySelector('h3');
                if (productNameElement) {
                    const productName = productNameElement.textContent.toLowerCase();

                    if (productName.includes(searchTerm)) {
                        productoDiv.style.display = '';
                    } else {
                        productoDiv.style.display = 'none';
                    }
                }
            });
        });
        // --- FIN: CÓDIGO PARA EL BUSCADOR DE PRODUCTOS ---

        // --- INICIO: CÓDIGO PARA EL ORDENAMIENTO DE PRODUCTOS ---
        const orderSelect = document.getElementById('ordenar');

        orderSelect.addEventListener('change', function() {
            const orderType = this.value;
            let sortedProducts = [...allProducts];

            switch (orderType) {
                case 'precio-menor':
                    sortedProducts.sort((a, b) => {
                        const precioA = parseFloat(a.dataset.precioUnidad); // <--- CAMBIADO
                        const precioB = parseFloat(b.dataset.precioUnidad); // <--- CAMBIADO
                        return precioA - precioB;
                    });
                    break;
                case 'precio-mayor':
                    sortedProducts.sort((a, b) => {
                        const precioA = parseFloat(a.dataset.precioUnidad); // <--- CAMBIADO
                        const precioB = parseFloat(b.dataset.precioUnidad); // <--- CAMBIADO
                        return precioB - precioA;
                    });
                    break;
                case 'nombre-az':
                    sortedProducts.sort((a, b) => {
                        const nombreA = a.dataset.nombre.toLowerCase();
                        const nombreB = b.dataset.nombre.toLowerCase();
                        return nombreA.localeCompare(nombreB);
                    });
                    break;
                case 'nombre-za':
                    sortedProducts.sort((a, b) => {
                        const nombreA = a.dataset.nombre.toLowerCase();
                        const nombreB = b.dataset.nombre.toLowerCase();
                        return nombreB.localeCompare(nombreA);
                    });
                    break;
                default:
                    // No hacer nada, dejar en el orden original
                    break;
            }

            // Limpiar el contenedor y volver a agregar los productos ordenados
            productosContainer.innerHTML = ''; // Limpiar el contenedor
            sortedProducts.forEach(productoDiv => {
                productosContainer.appendChild(productoDiv); // Agregar cada producto ordenado
            });
        });
        // --- FIN: CÓDIGO PARA EL ORDENAMIENTO DE PRODUCTOS ---
    });
</script>

<script>
    setTimeout(() => {
        const alert = document.querySelector('.custom-alert');
        if (alert) {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }
    }, 4000); // 4 segundos
</script>



@endsection

</html>