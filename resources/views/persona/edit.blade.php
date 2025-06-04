<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @extends('dashboard.index')
  <title>Personas</title>
  <link rel="stylesheet" href="{{ asset('css/personasEstilos/estilos.css') }}">



  <link rel="stylesheet" href="styles.css" />
  <script src="script.js"></script>




</head>




@section('contenido')
<h2>Editar Personas</h2>
<div class="container">

  <form action="{{ route('persona.update', $persona->id) }}" method="POST" class="formulario">
    @csrf
    @method('PUT')
    <div class="form-columns">

      <div class="form-group">

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" required value="{{ $persona->nombre }}">
        @error('nombre')
        <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
        @enderror

        <label for="dpi">DPI</label>
        <input type="text" name="dpi" id="dpi" placeholder="DPI" required value="{{ $persona->dpi }}">
        @error('dpi')
        <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
        @enderror

        <label for="correo">Correo-Electronico</label>
        <input type="email" name="correo" id="correo" placeholder="Correo-Electronico" required value="{{ $persona->correo }}">
        @error('correo')
        <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
        @enderror

        <label for="telefono">Teléfono</label>
        <input type="text" name="telefono" id="telefono" placeholder="0000-0000" required value="{{ $persona->telefono }}">
        @error('telefono')
        <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
        @enderror

        <label for="direccion"> Dirección</label>
        <input type="text" name="direccion" id="direccion" placeholder="Dirección" required value="{{ $persona->direccion }}">
        @error('direccion')
        <div class="error-message"><i class="fas fa-exclamation-circle" style="color: red;"></i> {{ $message }}</div>
        @enderror
      </div>


    </div>





     <div class="grupoBotones">
          <button type="submit" class="btn-guardar">Guardar</button>
          <a href="{{ route('persona.index') }}?cancelado=1" class="btn-cancelar">Cancelar</a>
        </div>
   

  </form>
</div>


<script>
  document.getElementById('telefono').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // Eliminar caracteres no numéricos
    if (value.length > 4) {
      value = value.slice(0, 4) + '-' + value.slice(4);
    }
    e.target.value = value.slice(0, 9); // Limitar a 9 caracteres (8 números + 1 guion)
  });
</script>




@endsection

</html>