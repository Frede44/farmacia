<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login farmacia</title>
</head>

<body>

    <ul class="background">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <div class="container">

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="container-form">
    <img class="imagen" src="{{ asset('image/inicio_sesion}.png') }}" alt="imagen inisio de sesion">
    <form action=" {{ route('login.store') }}" method="POST">
        @csrf
     
        <input type="email" id="email" name="email" required  placeholder="Correo electronico"><br><br>

     
        <input type="password" placeholder="Contraseña" id="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>
</div>
</div>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
   


</body>

</html>