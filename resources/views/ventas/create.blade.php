<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Usuarios</title>
    <link rel="stylesheet" href="{{ asset('css/ventasEstilos/ventasEstilos.css') }}">



    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>




</head>

@section('contenido')
@section('contenido')
<div class="container">
    <div class="productos">

        <!-- Barra de búsqueda y orden -->
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

        <!-- Productos -->
        <div class="container-productos">

            <!-- Producto ejemplo -->
            <div class="producto" id="1">
                <img src="https://walmartgt.vtexassets.com/arquivos/ids/292903-800-450?v=637959264591800000&width=800&height=450&aspect=true"
                    alt="Producto 1">
                <h4 class="categoria">categoria</h4>
                <h3>Producto 1</h3>
                <p>Descripción del producto 1</p>
                <div class="precio-stock">
                    <span class="precio">$10.00</span>
                    <span class="stock">Stock: 5</span>
                </div>
                <div class="div-btn">
                    <button class="agregar-unidad">Agregar unidad</button>
                    <button class="agregar-caja">Agregar caja</button>
                </div>
            </div>

            <!-- Repite estructura para otros productos -->
            <div class="producto" id="2">
                <img src="https://walmartgt.vtexassets.com/arquivos/ids/292903-800-450?v=637959264591800000&width=800&height=450&aspect=true"
                    alt="Producto 2">
                <h4 class="categoria">categoria</h4>
                <h3>Producto 2</h3>
                <p>Descripción del producto 2</p>
                <div class="precio-stock">
                    <span class="precio">$10.00</span>
                    <span class="stock">Stock: 5</span>
                </div>
                <div class="div-btn">
                    <button class="agregar-unidad">Agregar unidad</button>
                    <button class="agregar-caja">Agregar caja</button>
                </div>
            </div>

            <div class="producto" id="3">
                <img src="https://images.ctfassets.net/ir0g9r0fng0m/4lVEwmULVPy7YHTqAx6BwA/596dfdc73483e653ffce87c9f2009667/tylenol-caja-con-frasco-40-tabletas-980-x-980-px-1-es-mx"
                    alt="Producto 3">
                <h4 class="categoria">categoria</h4>
                <h3>Producto 3</h3>
                <p>Descripción del producto 3</p>
                <div class="precio-stock">
                    <span class="precio">$10.00</span>
                    <span class="stock">Stock: 5</span>
                </div>
                <div class="div-btn">
                    <button class="agregar-unidad">Agregar unidad</button>
                    <button class="agregar-caja">Agregar caja</button>
                </div>
            </div>

            <div class="producto" id="4">
                <img src="https://walmartgt.vtexassets.com/arquivos/ids/292903-800-450?v=637959264591800000&width=800&height=450&aspect=true"
                    alt="Producto 4">
                <h4 class="categoria">categoria</h4>
                <h3>Producto 4</h3>
                <p>Descripción del producto 4</p>
                <div class="precio-stock">
                    <span class="precio">$10.00</span>
                    <span class="stock">Stock: 5</span>
                </div>
                <div class="div-btn">
                    <button class="agregar-unidad">Agregar unidad</button>
                    <button class="agregar-caja">Agregar caja</button>
                </div>
            </div>

            <div class="producto" id="5">
                <img src="https://images.ctfassets.net/ir0g9r0fng0m/4lVEwmULVPy7YHTqAx6BwA/596dfdc73483e653ffce87c9f2009667/tylenol-caja-con-frasco-40-tabletas-980-x-980-px-1-es-mx"
                    alt="Producto 5">
                <h4 class="categoria">categoria</h4>
                <h3>Producto 5</h3>
                <p>Descripción del producto 5</p>
                <div class="precio-stock">
                    <span class="precio">$10.00</span>
                    <span class="stock">Stock: 5</span>
                </div>
                <div class="div-btn">
                    <button class="agregar-unidad">Agregar unidad</button>
                    <button class="agregar-caja">Agregar caja</button>
                </div>
            </div>

        </div> <!-- Fin de productos -->

    </div>

    <!-- Carrito -->
    <div class="container-carrito">
        <div class="carito-titulo">
            <h3 class="activo" id="btnCarrito" style="cursor:pointer">Carrito</h3>
            <h3 id="btninfo" style="cursor:pointer">Cliente</h3>
        </div>

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
                        <td colspan="6" style="text-align: center; padding: 20px;">El carrito está vacío. Agregue productos.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="contenido-informacion">
            <h3>Información del cliente</h3>
            <div class="cliente_ya_registrado">
                <p>Clientes registrados</p>
                <div class="lista_clientes">
                    @foreach($personas as $persona)
                    <div class="cliente">
                        <p class="nombre">{{ $persona->nombre }}</p>
                        <div class="info_cliente">
                            <div class="dpi_cliente">
                                ID: <span>{{ $persona->id }}</span>
                            </div>
                            <div class="tel_cliente">
                                <span>Tel: {{ $persona->telefono }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
      

        <div class="info_cliente">
            <label for="nombre_cliente">Nombre:</label>
            <input type="text" id="nombre_cliente" placeholder="Nombre del cliente">
            <label for="dpi_cliente">DPI:</label>
            <input type="text" id="dpi_cliente" placeholder="DPI del cliente">
            <label for="telefono_cliente">Teléfono:</label>
            <input type="text" id="telefono_cliente" placeholder="Teléfono del cliente">
            <label for="direccion_cliente">Dirección:</label>
            <input type="text" id="direccion_cliente" placeholder="Dirección del cliente">
        </div>
    </div>

    <div class="total">
        <h3 class="titulo_total">Resumen de venta</h3>
        <div class="info_clienteR"></div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin: 10px;">
            <p>Subtotal:</p>
            <span class="subtotal">$0.00</span>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin: 10px;">
            <p>Total:</p>
            <span id="total">$0.00</span>
        </div>
    </div>

    <button id="comprar">Comprar</button>
    <button id="imprimir-ticket">Imprimir ticket</button>
</div>

  <script>
        document.addEventListener("DOMContentLoaded", () => {
            const stockElements = document.querySelectorAll('.stock');

            stockElements.forEach(el => {
                // Extraer solo el número usando expresión regular
                const match = el.textContent.match(/\d+/);
                const stockValue = match ? parseInt(match[0]) : 0;

                if (!isNaN(stockValue)) {
                    el.style.color = stockValue > 50 ? 'green' : 'red';
                    el.style.fontWeight = 'bold';
                }
            });
        });
    </script>

<script>
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

        const carritoTabla = document.querySelector('#tabla-carrito tbody');
        const totalDisplay = document.getElementById('total');
        const subtotalDisplay = document.querySelector('.subtotal');
        let carrito = [];

        const actualizarTablaCarrito = () => {
            const thead = document.getElementById('carrito-thead');
            carritoTabla.innerHTML = '';

            if (carrito.length === 0) {
                carritoTabla.innerHTML = `
                    <tr id="carrito-vacio">
                        <td colspan="6">El carrito está vacío. Agregue productos.</td>
                    </tr>`;
                totalDisplay.textContent = "$0.00";
                subtotalDisplay.textContent = "$0.00";
                thead.style.display = 'none';
                return;
            }

            thead.style.display = '';
            let total = 0;
            carrito.forEach((item, index) => {
                const subtotal = item.precio * item.cantidad;
                total += subtotal;

                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${item.nombre}</td>
                    <td>${item.tipo}</td>
                    <td>$${item.precio.toFixed(2)}</td>
                    <td>
                        <input type="number" min="1" value="${item.cantidad}" data-index="${index}" class="cambiar-cantidad">
                    </td>
                    <td>$${subtotal.toFixed(2)}</td>
                    <td>
                        <button data-index="${index}" class="eliminar-producto"><i class="fa-regular fa-trash-can"></i></button>
                    </td>`;
                carritoTabla.appendChild(fila);
            });

            totalDisplay.textContent = `$${total.toFixed(2)}`;
            subtotalDisplay.textContent = `$${total.toFixed(2)}`;
        };

        const agregarProducto = (nombre, precio, tipo) => {
            const indexExistente = carrito.findIndex(p => p.nombre === nombre && p.tipo === tipo);
            if (indexExistente !== -1) {
                carrito[indexExistente].cantidad += 1;
            } else {
                carrito.push({ nombre, precio, tipo, cantidad: 1 });
            }
            actualizarTablaCarrito();
        };

        document.querySelectorAll('.producto').forEach(producto => {
            const nombre = producto.querySelector('h3').textContent;
            const precioTexto = producto.querySelector('.precio').textContent;
            const precio = parseFloat(precioTexto.replace('$', ''));

            producto.querySelector('.agregar-unidad').addEventListener('click', () => {
                agregarProducto(nombre, precio, 'Unidad');
            });
            producto.querySelector('.agregar-caja').addEventListener('click', () => {
                agregarProducto(nombre, precio * 10, 'Caja');
            });
        });

        carritoTabla.addEventListener('click', e => {
            if (e.target.closest('.eliminar-producto')) {
                const index = e.target.closest('button').dataset.index;
                carrito.splice(index, 1);
                actualizarTablaCarrito();
            }
        });

        carritoTabla.addEventListener('input', e => {
            if (e.target.classList.contains('cambiar-cantidad')) {
                const index = e.target.dataset.index;
                const nuevaCantidad = parseInt(e.target.value);
                if (nuevaCantidad > 0) {
                    carrito[index].cantidad = nuevaCantidad;
                    actualizarTablaCarrito();
                }
            }
        });

        // Inicializa las vistas de carrito e información de cliente
        const carritoBtn = document.getElementById('btnCarrito');
        const infoBtn = document.getElementById('btninfo');
        carritoBtn.addEventListener('click', () => {
            carritoBtn.classList.add('activo');
            infoBtn.classList.remove('activo');
            document.querySelector('.carrito-productos').style.display = 'block';
            document.querySelector('.contenido-informacion').style.display = 'none';
        });
        infoBtn.addEventListener('click', () => {
            infoBtn.classList.add('activo');
            carritoBtn.classList.remove('activo');
            document.querySelector('.carrito-productos').style.display = 'none';
            document.querySelector('.contenido-informacion').style.display = 'block';
        });
        document.querySelector('.carrito-productos').style.display = 'block';
        document.querySelector('.contenido-informacion').style.display = 'none';
    });
</script>

 <script>
        const carritoBtn = document.getElementById('btnCarrito');
        const infoBtn = document.getElementById('btninfo');
    
        infoBtn.addEventListener('click', () => {
            carritoBtn.classList.remove('activo');
            infoBtn.classList.add('activo');
    
            const contenidoInformacion = document.querySelector('.contenido-informacion');
            const carritoproductos = document.querySelector('.carrito-productos');
    
            carritoproductos.style.display = 'none';
            contenidoInformacion.style.display = 'block';
        });
    
        carritoBtn.addEventListener('click', () => {
            infoBtn.classList.remove('activo');
            carritoBtn.classList.add('activo');
    
            const contenidoInformacion = document.querySelector('.contenido-informacion');
            const carritoproductos = document.querySelector('.carrito-productos');
    
            contenidoInformacion.style.display = 'none';
            carritoproductos.style.display = 'block';
        });
    
        // Inicializar para mostrar el carrito al cargar
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelector('.carrito-productos').style.display = 'block';
            document.querySelector('.contenido-informacion').style.display = 'none';
        });
    </script>

 <script>
    document.addEventListener("DOMContentLoaded", () => {
        const clienteElements = document.querySelectorAll('.cliente');
        const inputNombre = document.getElementById('nombre_cliente');
        const inputDpi = document.getElementById('dpi_cliente');
        const inputTelefono = document.getElementById('telefono_cliente');
        const inputDireccion = document.getElementById('direccion_cliente');
        const resumenInfo = document.querySelector('.total .info_clienteR');

        clienteElements.forEach(cliente => {
            cliente.addEventListener('click', () => {
                const nombre = cliente.querySelector('.nombre').textContent;
                const dpi = cliente.querySelector('.dpi_cliente span').textContent;
                const tel = cliente.querySelector('.tel_cliente span').textContent.replace('Tel: ', '');

                // Rellenar inputs
                inputNombre.value = nombre;
                inputDpi.value = dpi;
                inputTelefono.value = tel;

                // Actualizar resumen
                resumenInfo.innerHTML = `
                    <p class="nombreResumen">Nombre: ${nombre}</p>
                    <p class="ResumenA">DPI: ${dpi}</p>
                    <p class="ResumenA" >Teléfono: ${tel}</p>
                `;

                resumenInfo.style.display = 'block';

            });
        });
    });
</script>
@endsection

@endsection

</html>