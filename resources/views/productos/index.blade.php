<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('dashboard.index')
    <title>Productos</title>
    <link rel="icon" type="image/png" href="{{ asset('img/pestaña.png') }}">
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/indexProductos.css') }}">
 <link rel="icon" href="{{ asset('img/LocoFarmacia.png') }}" type="image/png">


    <link rel="stylesheet" href="styles.css" />
    <script src="script.js"></script>



</head>


<body>
    @section('contenido')
    <h2>PRODUCTOS</h2>
    <div class="btn_div">
        <a href="{{ route('productos.create') }}" style="text-decoration:none;">
            <button class="btnAgregar">+Producto</button>
        </a>
    </div>

    <div class="table-container">



        <table id="tablaUsuarios" class="display nowrap">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th class="nombre">Producto</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Imagen</th>
                    <th>Acciones</th>




                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                <tr>
                    <td>{{ $producto->codigo }}</td>
                    <td>
                        <span class="nombre-corto">
                            {{ \Illuminate\Support\Str::limit($producto->nombre, 27, '...') }}
                            @if(strlen($producto->nombre) > 27)
                            <i class="fa-solid fa-eye icono-ojo" onclick="mostrarDescripcion(this)" data-texto="{{ $producto->nombre }}"></i>
                            @endif
                        </span>
                    </td>

                    <td>
                        <span class="descripcion-corta">
                            {{ \Illuminate\Support\Str::limit($producto->descripcion, 15, '...') }}
                            @if(strlen($producto->descripcion) > 15)
                            <i class="fa-solid fa-eye icono-ojo" onclick="mostrarDescripcion(this)" data-texto="{{ $producto->descripcion }}"></i>
                            @endif
                        </span>
                    </td>

                    <td>{{ $producto->categoria->nombre }}</td>
                    <td>
                        @if($producto->imagen)
                        <img src="{{ asset('imagenes/' . $producto->imagen) }}" width="50" height="50" alt="Imagen del producto" onclick="mostrarModal(this)" style="cursor: pointer;">
                        @else
                        Sin Imagen
                        @endif
                    </td>


                    {{-- Acciones --}}
                    <td>
                        <!-- Botón Editar -->
                        <div class="flex flex-col justify-center items-center gap-2">
                            <form method="GET">
                                @csrf
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btnEditar">
                                    <i class="fa-regular fa-pen-to-square fa-lg" style="color:rgb(255, 255, 255);"></i>
                                </a>
                            </form>

                            <!-- Botón Eliminar -->
                            <form action="{{route('productos.destroy',$producto->id)}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="btnEliminar" onclick="confirmarEliminacion(event, this)">
                                    <i class="fa-regular fa-trash-can fa-xl" style="color:rgb(255, 255, 255);"></i>
                                </a>
                            </form>
                        </div>
                    </td>

                </tr>
                @endforeach

                <!-- Modal para mostrar la descripción completa (se reutiliza para nombre también) -->
                <div id="modalDescripcion" class="modal-descripcion" style="display:none;">
                    <div class="modal-contenido">
                        <span class="cerrar-modal" onclick="cerrarDescripcion()">&times;</span>
                        <p id="descripcionCompleta"></p>
                    </div>
                </div>

                <!-- Modal para mostrar imagen -->
                <div id="modalImagen" onclick="cerrarModal()" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background-color:rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:1000;">
                    <img id="imagenModal" src="" style="max-width:90%; max-height:90%; border:4px solid white; border-radius:10px;">
                </div>


                <script>
                    function confirmarEliminacion(event, elemento) {
                        event.preventDefault();
                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¡Esta acción no se puede deshacer!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                elemento.closest('form').submit();
                            }
                        });
                    }
                </script>

                <script>
                    function mostrarModal(img) {
                        var modal = document.getElementById('modalImagen');
                        var imagenModal = document.getElementById('imagenModal');
                        imagenModal.src = img.src;
                        modal.style.display = 'flex';
                    }

                    function cerrarModal() {
                        document.getElementById('modalImagen').style.display = 'none';
                    }
                </script>


            </tbody>
        </table>
    </div>
    <div style="height:1px;"></div>
    </div>


</body>

@endsection

</html>