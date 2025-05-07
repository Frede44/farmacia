<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zoho Style Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login.css')}}" />
    <style>

    </style>
</head>

<body>


    <div class="container">
        <div class="left">
            <img src="{{asset('img/logoFcF.png')}}" alt="Login illustration" />
        </div>
        <div class="right">
            <h2>Inicio de Sesión</h2>
            <form action=" {{ route('login.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="email" placeholder="ejemplo@email.com" name="email" />
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" name="password"/>
                </div>
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
                <button type="submit" class="btn">Inicio de Sesión</button>

            </form>


        </div>
    </div>
</body>

</html>