<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Agregar Bootstrap para diseño responsivo -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Estilos generales del body */
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Barra de navegación superior */
        .navbar {
            background-color: #2c3e50;
        }

        .navbar-brand {
            color: #ecf0f1 !important;
        }

        .nav-link {
            color: #ecf0f1 !important;
        }

        .nav-link:hover {
            color: #3498db !important;
        }

        /* Barra lateral */
        .sidebar {
            background-color: #34495e;
            color: white;
            height: 100vh;
            padding: 20px;
            border-radius: 8px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px;
            transition: width 0.3s ease;
        }

        .sidebar a {
            color: white;
            display: block;
            margin: 10px 0;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar a:hover {
            background-color: #2980b9;
            border-radius: 5px;
            padding: 10px;
        }

        /* Contenido principal */
        .content {
            margin-left: 270px; /* Deja espacio para la barra lateral */
            padding: 20px;
        }

        /* Pie de página */
        .footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        /* Navbar en dispositivos pequeños */
        .navbar-nav .nav-link {
            margin-left: 20px;
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                height: auto;
                margin-bottom: 20px;
                width: 100%;
            }

            .content {
                margin-left: 0;
            }

            .welcome-box {
                margin-top: 30px;
            }
        }

        /* Mejorar el estilo de los cuadros */
        .row {
            margin-top: 20px;
        }

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('dashboard') }}">DECOR CENTER</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="{{ route('dashboard') }}">Inicio</a>
                    @if(Auth::check()) <!-- Solo mostrar esto si el usuario está logueado -->
                        <a class="nav-link" href="{{ route('profile.edit') }}">Perfil</a>
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-white">Salir</button>
                        </form>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                        <a class="nav-link" href="{{ route('register') }}">Crear cuenta</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container-fluid mt-4">
        <div class="row">
            <!-- Si el usuario no está autenticado, muestra el cuadro de bienvenida -->
            @guest
            <div class="col-12 welcome-box">
                <h2>Bienvenido a DECOR CENTER</h2>
                <p>Sistema de Inventario</p>
                <!-- Botones de autenticación -->
                <div class="auth-buttons">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="btn btn-success btn-lg">Crear cuenta</a>
                </div>
            </div>
            @endguest

            <!-- Contenido de la página para usuarios logueados -->
            @auth
            <div class="col-md-3 sidebar">
                <h4>Bienvenido, {{ Auth::user()->name }}</h4>
                <a href="{{ route('productos.index') }}">Ver Productos</a>
                <a href="{{ route('productos.create') }}">Agregar Producto</a>
                <a href="{{ route('dashboard') }}">Panel de Control</a>
                <a href="{{ route('inventory.logs') }}">Historial de Inventario</a>
            </div>

            <div class="col-md-9 content">
                @yield('content')
            </div>
            @endauth
        </div>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>&copy; 2025 DECOR CENTER. Todos los derechos reservados.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
