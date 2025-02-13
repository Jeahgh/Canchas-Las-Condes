<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canchas Las Condes</title>


    
    {{-- estilos generales de la página  --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>


    {{-- header con inicio de sesión --}}
    @if(Auth::check())
    <header class="nav-header">



        
        <div class="user-menu">
            <span>Hola, {{ Auth::user()->nombre }} - {{ Auth::user()->rol == 1 ? 'Administrador' : 'Vecino' }}</span>
            <div class="user-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                </svg>
            </div>
            <div class="dropdown-menu">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Cerrar sesión</button>
                </form>
            </div>
        </div>   
    </header>
    @endif


    {{-- <div class="main-container"> --}}
    <div class="sidebar" id="sidebar">


        <a href="{{ route('home') }}">
            <img src="{{ asset('imagenes/logo-las-condes-blanco.avif') }}" 
            alt="Logo Las Condes" 
            class="img-fluid logo-centered">
        </a>

        <nav class="menu-links">
            <a href="{{ route('canchas.index') }}"><i class="fas fa-calendar-check"></i> Reserva de canchas</a>
            <a href="{{ route('home') }}"><i class="fa-solid fa-tree"></i> Parque</a>
            <a href="{{ route('contacto.index') }}"><i class="fas fa-envelope"></i> Contáctanos</a>
            @if(Auth::check() && Auth::user()->rol == 1)
                <a href="{{ route('usuarios.index') }}"><i class="fas fa-users"></i> Usuarios</a>
            @endif
        </nav>

    </div>
    <div class="content">
        @yield('content')
    </div>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome para los íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap JavaScript (al final del body) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- En esta parte va toda la información --}}

</body>
</html>