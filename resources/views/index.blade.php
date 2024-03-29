<!DOCTYPE html>
<html class="theme-light">
<head>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                @auth
                    <script>window.location = "{{ route('home') }}";</script>
                @else
                    <h1 class="mb-4">Bem-vindo ao Nosso Site!</h1>
                    <p class="lead mb-4">Faça login para acessar sua conta ou registre-se para criar uma nova.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg mr-3">Entrar</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg">Registrar</a>
                @endauth
            </div>
        </div>
    </div>
</body>
</html>
