<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Canchas</title>

    @if(Auth::check())
    <header class="nav-header">
        <div class="user-menu">
            <span>Hola, {{ Auth::user()->nombre }}</span>
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
    
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background-color: #181f47;
            color: white;
            padding: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            margin: 5px 0;
        }
        .sidebar a:hover {
            background-color: #38374b22;
        }
        .content {
            flex-grow: 1;
            padding: 20px;
        }

        .nav-header {
            background-color: #181f47;
            color: white;
            padding: 12px 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .user-menu {
                position: relative;
                display: flex;
                align-items: center;
                gap: 8px;
                color: white;
                cursor: pointer;
            }

            .user-icon {
                background: rgba(255, 255, 255, 0.1);
                padding: 8px;
                border-radius: 50%;
                display: flex;
                align-items: center;
            }

            .dropdown-menu {
                position: absolute;
                top: 100%;
                right: 0;
                background: white;
                border-radius: 8px;
                padding: 8px;
                margin-top: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                display: none;
            }


            .dropdown-menu button {
                width: 100%;
                padding: 8px 16px;
                border: none;
                background: none;
                color: #333;
                cursor: pointer;
                text-align: left;
            }

            .dropdown-menu button:hover {
                background: #f5f5f5;
                border-radius: 4px;
            }

            .user-menu:hover .dropdown-menu {
                display: block;
            }



    </style>
</head>
<body>
    <div class="sidebar">
        <img src="{{ asset('imagenes/logo-las-condes-blanco.avif') }}" 
        alt="Logo Las Condes" class="img-fluid" style="max-width: 100px;"> <!-- Ajusta el tamaño del logo -->
        <a href="{{ route('home') }}"><i class="fas fa-home"></i> Inicio</a>
        <a href="{{ route('contacto.index') }}"><i class="fas fa-envelope"></i> Contáctanos</a>
        <a href="{{ route('canchas.index') }}"><i class="fas fa-calendar-check"></i> Reserva</a>
        <a href="{{ route('usuarios.index') }}"><i class="fas fa-users"></i> Usuarios</a>
    </div>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome para los íconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Bootstrap JavaScript (al final del body) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>