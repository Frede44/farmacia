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
    <form action="{{ route('productos.store') }}" method="POST">
            
        @csrf
            <div class="form-columns">
                <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" id="codigo" name="codigo" placeholder="Código">

                    <label for="producto">Producto</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto">

                    <label for="precio_venta">Precio venta</label>
                    <input type="number" id="precio_venta" name="precio_venta" placeholder="Precio de venta">
                  
                </div>

                <div class="form-group">
                    

                    <!--<label for="categoria" class="txtcategoria">Categoría</label >
                    <select id="categoria" name="categoria" >
                        <option value="categoria1">Categoría 1</option>
                        <option value="categoria2">Categoría 2</option>
                        <option value="categoria3">Categoría 3</option>
</select>-->
                    <label for="descripcion">Descripción</label>
                    <textarea id="descripcion" name="descripcion" placeholder="Descripción del producto"></textarea>
                    </textarea>
                    <label for="imagen">Seleccionar imagen</label>
                  <div class="image-box">Sube un imagen
                      <input type="file" id="imagen" name="imagen" accept="image/*">
                  </div>
                  <!-- Contenedor para vista previa -->
                  <div id="preview" class="preview-box"></div>



                    
                </div>
            </div>

            <div class="grupoBotones">
            
            <button type="submit" class="btn-guardar">Guardar</button>
            <a href="" class="btn-cancelar">Cancelar</a>
            </div>
        </form>
    </div>
    
    </body>
    
    @endsection



</html>