<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <title>Login farmacia</title>
</head>

<body>
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
        <h1>Login</h1>
            <form action=" {{ route('login.store') }}" method="POST">
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required><br><br>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>

</html>