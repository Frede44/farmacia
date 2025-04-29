<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    @extends('dashboard.index')
    <title>Vista productos</title>
    <link rel="stylesheet" href="{{ asset('css/productosEstilos/createProductos.css') }}"> 
    <!-- Iconos-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    

<link href="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.css" rel="stylesheet" integrity="sha384-7OG4hcSLohnvJO+lbBJjJFRAjv+fviYGllCE2hGpAflRok8nXfvl63MOkYjzqGJm" crossorigin="anonymous">
 
<script src="https://cdn.datatables.net/v/dt/dt-2.2.2/b-3.2.3/b-colvis-3.2.3/b-html5-3.2.3/b-print-3.2.3/r-3.0.4/rr-1.5.0/sb-1.8.2/datatables.min.js" integrity="sha384-FFQxq76hs6g5HqAK1+xdA0Xtd3QmeEI7+l9TCXGEhfCcakwq6vPL0ohx5R2dhiOP" crossorigin="anonymous"></script>
</head>
@section('contenido')


<body>

  <h2>Tabla de Usuarios</h2>
  <table id="tablaUsuarios" class="display nowrap" style="width:100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Edad</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>1</td><td>Ana</td><td>ana@email.com</td><td>28</td></tr>
      <tr><td>2</td><td>Juan</td><td>juan@email.com</td><td>34</td></tr>
      <tr><td>3</td><td>María</td><td>maria@email.com</td><td>22</td></tr>
      <tr><td>4</td><td>Carlos</td><td>carlos@email.com</td><td>30</td></tr>
      <tr><td>5</td><td>Lucía</td><td>lucia@email.com</td><td>25</td></tr>
      <!-- Puedes agregar más filas -->
    </tbody>
  </table>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

  <!-- Inicialización -->
  <script>
    $(document).ready(function () {
      $('#tablaUsuarios').DataTable({
        dom: 'Bfrtip',
        buttons: [
          'copyHtml5',
          'excelHtml5',
          'pdfHtml5'
        ],
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100],
        responsive: true,
        language: {
          search: "Buscar:",
          lengthMenu: "Mostrar _MENU_ registros",
          info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
          paginate: {
            previous: "Anterior",
            next: "Siguiente"
          },
          zeroRecords: "No se encontraron resultados"
        }
      });
    });
  </script>
</body>


</html>