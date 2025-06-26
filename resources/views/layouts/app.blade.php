<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Velho Recanto')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <img src="/img/logo.png" width="3%" alt="Logo">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/acoes">Acoes</a></li>
                    <li class="nav-item"><a class="nav-link" href="/campanhas">Campanhas</a></li>
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item"><span class="nav-link">{{ Auth::user()->name }}</span></li>
                        <li class="nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="/register">Cadastro</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>
    @stack('scripts')
</body>
</html>