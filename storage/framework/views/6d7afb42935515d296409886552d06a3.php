<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Tipografía corporativa */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Navbar elegante */
        .navbar {
            background-color: #001f3f; /* azul oscuro corporativo */
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.15);
            padding: 0.75rem 1.5rem;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #ffffff !important;
            letter-spacing: 1.2px;
            user-select: none;
        }

        .nav-link {
            color: #cbd5e1 !important;
            font-weight: 500;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem;
        }

        .nav-link:hover, .nav-link:focus {
            color: #60a5fa !important; /* azul claro */
            text-decoration: underline;
        }

        .btn-link.text-white {
            color: #cbd5e1 !important;
            font-weight: 500;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }

        .btn-link.text-white:hover {
            color: #60a5fa !important;
            text-decoration: underline;
        }

        #toggleSidebar {
            background: none;
            border: none;
            color: #cbd5e1;
            font-size: 1.6rem;
            cursor: pointer;
            margin-right: 1rem;
            transition: color 0.3s ease;
            z-index: 1051;
        }

        #toggleSidebar:hover {
            color: #60a5fa;
        }

        /* Sidebar */
        .sidebar {
            background-color: #0b172a; /* azul muy oscuro */
            color: #e0e7ff; /* azul claro */
            height: 100vh;
            width: 270px;
            padding: 30px 25px;
            position: fixed;
            top: 0;
            left: 0;
            box-shadow: 4px 0 12px rgb(0 0 0 / 0.2);
            border-radius: 0 15px 15px 0;
            overflow-y: auto;
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 1040;
            font-weight: 500;
            user-select: none;
        }

        body.sidebar-visible .sidebar {
            transform: translateX(0);
        }

        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #93c5fd; /* azul claro */
            letter-spacing: 0.05em;
        }

        .sidebar a {
            color: #cbd5e1;
            display: block;
            margin-bottom: 12px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 1rem;
            transition: background-color 0.3s ease, color 0.3s ease;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #2563eb; /* azul vibrante */
            color: #fff !important;
            box-shadow: 0 2px 8px rgb(37 99 235 / 0.5);
        }

        .sidebar .collapse a {
            font-size: 0.9rem;
            margin-left: 20px;
            padding-left: 18px;
            color: #a5b4fc;
        }

        /* Contenido principal */
        .content {
            margin-left: 0;
            padding: 2.5rem 3rem;
            transition: margin-left 0.3s ease;
            flex-grow: 1;
            min-height: calc(100vh - 80px);
            box-shadow: 0 0 15px rgb(0 0 0 / 0.05);
            border-radius: 12px;
            margin-top: 1rem;
            margin-bottom: 4rem;
        }

        body.sidebar-visible .content {
            margin-left: 270px;
        }

        /* Footer */
        .footer {
            background-color: #001f3f;
            color: #a5b4fc;
            text-align: center;
            padding: 15px 1rem;
            font-size: 0.9rem;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -2px 8px rgb(0 0 0 / 0.15);
            user-select: none;
        }

        /* Botones de autenticación */
        .auth-buttons a.btn {
            min-width: 160px;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .auth-buttons a.btn-primary {
            background-color: #2563eb;
            border: none;
        }

        .auth-buttons a.btn-primary:hover {
            background-color: #1d4ed8;
            box-shadow: 0 4px 12px rgb(29 78 216 / 0.4);
        }

        .auth-buttons a.btn-success {
            background-color: #16a34a;
            border: none;
        }

        .auth-buttons a.btn-success:hover {
            background-color: #15803d;
            box-shadow: 0 4px 12px rgb(21 128 61 / 0.4);
        }

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                border-radius: 0;
                box-shadow: none;
                transform: translateX(0);
                padding: 20px 15px;
            }

            body.sidebar-visible .content {
                margin-left: 0;
            }

            .content {
                padding: 1.5rem 1.5rem;
                margin-top: 1rem;
                margin-bottom: 3rem;
            }

            #toggleSidebar {
                display: none;
            }

            .navbar-brand {
                position: static !important;
                transform: none !important;
                margin-left: 0;
            }

            .navbar-nav {
                margin-top: 10px;
                justify-content: center;
            }
        }

        /* Estilos para el submenu de reportes */
        .sidebar a[data-bs-toggle="collapse"] {
            cursor: pointer;
            user-select: none;
            font-weight: 600;
            color: #93c5fd;
            margin-top: 10px;
        }

        .sidebar a[data-bs-toggle="collapse"]:hover {
            color: #60a5fa;
        }
    </style>
</head>
<body>

    <!-- Barra de navegación superior -->
    <nav class="navbar navbar-expand-lg navbar-dark position-relative">
        <div class="container position-relative">
            <button class="btn" id="toggleSidebar" aria-label="Toggle sidebar">
                ☰
            </button>
            <!-- Marca centrada -->
            <a class="navbar-brand position-absolute start-50 translate-middle-x" href="<?php echo e(route('dashboard')); ?>">
                DECOR CENTER
            </a>
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="navbar-nav">
                    <a class="nav-link" href="<?php echo e(route('dashboard')); ?>">Inicio</a>
                    <?php if(Auth::check()): ?>
                        <a class="nav-link" href="<?php echo e(route('profile.edit')); ?>">Perfil</a>
                        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="nav-link btn btn-link text-white">Salir</button>
                        </form>
                    <?php else: ?>
                        <a class="nav-link" href="<?php echo e(route('login')); ?>">Iniciar sesión</a>
                        <a class="nav-link" href="<?php echo e(route('register')); ?>">Crear cuenta</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenedor principal -->
    <div class="container-fluid mt-4">
        <div class="row">
            <?php if(auth()->guard()->guest()): ?>
            <div class="col-12 welcome-box text-center">
                <h2 class="mb-3" style="font-weight: 700; color: #1e293b;">Bienvenido a DECOR CENTER</h2>
                <p class="mb-4" style="font-size: 1.1rem; color: #475569;">Sistema de Inventario</p>
                <div class="auth-buttons d-flex justify-content-center gap-3">
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-primary btn-lg">Iniciar sesión</a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-success btn-lg">Crear cuenta</a>
                </div>
            </div>
            <?php endif; ?>

            <?php if(auth()->guard()->check()): ?>
            <div class="sidebar" id="sidebar" role="navigation" aria-label="Sidebar navigation">
                <h4>👋 Bienvenido, <?php echo e(Auth::user()->name); ?></h4>
                <a href="<?php echo e(route('dashboard')); ?>">🏠 Panel de Control</a>
                <a href="<?php echo e(route('productos.index')); ?>">🛍️ Ver Productos</a>
                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin|editor')): ?>
                <a href="<?php echo e(route('productos.create')); ?>">➕ Agregar Producto</a>
                <a href="<?php echo e(route('inventory.logs')); ?>">📜 Historial de Inventario</a>
                <?php endif; ?>
                <div class="mt-3">
                    <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?>
                    <a class="d-block" data-bs-toggle="collapse" href="#submenuReportes" role="button" aria-expanded="false" aria-controls="submenuReportes">
                        📊 Reportes ▾
                    </a>
                    <?php endif; ?>
                    <div class="collapse" id="submenuReportes">
                        <a href="<?php echo e(route('reportes.ventas_por_mes')); ?>" class="ms-3 d-block mt-2">📈 Ventas por mes</a>
                        <a href="<?php echo e(route('reportes.productos_mas_vendidos')); ?>" class="ms-3 d-block mt-2">🔥 Productos más vendidos</a>
                        <a href="<?php echo e(route('reportes.variacion_stock')); ?>" class="ms-3 d-block mt-2">⚠️ Variación de Stock</a>
                        <a href="<?php echo e(route('reportes.usuarios_registrados')); ?>" class="ms-3 d-block mt-2">👥 Usuarios Registrados</a>
                    </div>
                </div>
            </div>

            <main class="content" role="main" tabindex="-1">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
            <?php endif; ?>
        </div>
    </div>

    <!-- Pie de página -->
    <footer class="footer" role="contentinfo">
        <p>&copy; 2025 DECOR CENTER. Todos los derechos reservados.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function () {
            document.body.classList.toggle('sidebar-visible');
        });
    </script>       
</body>
</html>
<?php /**PATH C:\xampp\htdocs\DECOCENTER\decorcenter\resources\views/layouts/plantilla.blade.php ENDPATH**/ ?>