<html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyecto cbit</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
@vite('resources/css/app.css')
@stack('styles')
<script>
    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>

</head>
<body>
  
    <header> </header>

@if (auth()->check() && !request()->routeIs('iniciosesion', 'iniciosesion.post'))
    <div class="dashboard-shell">
        <aside class="dashboard-sidebar" aria-label="Navegación principal">
            <div class="dashboard-sidebar-title">CBIT</div>
            <nav aria-label="Secciones">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door" aria-hidden="true"></i>
                    <span>Panel principal</span>
                </a>
                @can('access-inventory')
                <a href="{{ url('/inventario') }}" class="nav-link {{ request()->routeIs('inventario.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam" aria-hidden="true"></i>
                    <span>Control de inventario</span>
                </a>
                @endcan
                @can('access-inventory')
                <a href="{{ route('mantenimientos.index') }}" class="nav-link {{ request()->routeIs('mantenimientos.*') ? 'active' : '' }}">
                    <i class="bi bi-tools" aria-hidden="true"></i>
                    <span>Mantenimientos</span>
                </a>
                @endcan
                <a href="{{ url('/empleados') }}" class="nav-link {{ request()->routeIs('empleados.*') ? 'active' : '' }}">
                    <i class="bi bi-people" aria-hidden="true"></i>
                    <span>Control de empleados</span>
                </a>
                <a href="{{ url('/_c_b_i_t') }}" class="nav-link {{ request()->routeIs('cbit.*') ? 'active' : '' }}">
                    <i class="bi bi-building" aria-hidden="true"></i>
                    <span>Otros Cbits</span>
                </a>
                <a href="{{ route('cursos.index') }}" class="nav-link {{ request()->routeIs('cursos.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text" aria-hidden="true"></i>
                    <span>Actividades</span>
                </a>
                @can('access-auditory')
                <a href="{{ route('auditoria.index') }}" class="nav-link {{ request()->routeIs('auditoria.*', 'auditorias.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-data" aria-hidden="true"></i>
                    <span>Auditoría</span>
                </a>
                @endcan
            </nav>
            <div class="dashboard-sidebar-logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger w-100">
                        <i class="bi bi-box-arrow-right me-2" aria-hidden="true"></i>
                        Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>
        <div class="dashboard-main">
            @yield('content')
        </div>
    </div>
@else
@yield('content') 
@endif

    <footer></footer>
</body>
</html>