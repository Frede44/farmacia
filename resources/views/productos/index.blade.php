<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Vista productos</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}"> 
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
@section('contenido')


<body>

    <div class="content">
        
        <h1>Contenido Productos</h1>

        

       <button class="btn-agregar" onclick="window.location.href='/dashboard/productos/create'">
    <i class="fas fa-plus"></i> Producto
</button>

        <!-- Tabla de productos -->
        <table>
            <thead>
                <tr>
                    <th class="titulo">Codigo</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                    
                    
                    
                </tr>
            </thead>
            <tbody>
                <tr class="datos">
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado" ><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado"><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado"><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr class="datos">
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado" ><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado"><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado"><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr class="datos">
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado" ><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado"><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado"><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr class="datos">
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado" ><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Producto A</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado"><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Producto b</td>
                    <td>Medicamento</td>
                    <td>$10.00</td>
                    <td>25</td>
                    <td class="acciones">
                        <button class="btn-editar"><i class="fas fa-edit"></i> Editar</button>
                        <button class="btn-estado"><i class="fas fa-exchange-alt"></i> Estado</button>
                    </td>
                </tr>
            </tbody>
        </table>

        
        <!-- Contenedor para los botones de paginación -->
<div class="npagina" id="pagination" style="text-align:center; margin-top: 15px;"></div>

    </div>

    @endsection
    

</body>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const rowsPerPage = 6; // nmero de filas por página
        const table = document.querySelector("table");// Seleccion de tabla
        const tbody = table.querySelector("tbody");
        const rows = Array.from(tbody.querySelectorAll("tr"));
        const paginationContainer = document.getElementById("pagination");

        function showPage(page) {
            const start = (page - 1) * rowsPerPage;
            const end = start + rowsPerPage;

            rows.forEach((row, index) => {
                row.style.display = index >= start && index < end ? "" : "none";
            });

            // Actualiza los botones activos
            const pageButtons = document.querySelectorAll("#pagination button");
            pageButtons.forEach((btn, idx) => {
                btn.classList.toggle("active", idx === page - 1);
            });
        }

        function setupPagination() {
            paginationContainer.innerHTML = "";
            const pageCount = Math.ceil(rows.length / rowsPerPage);

            for (let i = 1; i <= pageCount; i++) {
                const btn = document.createElement("button");
                btn.textContent = i;
                btn.addEventListener("click", () => showPage(i));
                paginationContainer.appendChild(btn);
            }
        }

        setupPagination();
        showPage(1); // Mostrar primera página al cargar
    });
</script>

</html>