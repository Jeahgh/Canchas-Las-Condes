<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome para los íconos -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<!-- Bootstrap JavaScript (al final del body) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!-- Main container -->
<div class="container-fluid min-vh-100 d-flex">
    <!-- Left column for login form -->
    <div class="col-md-4 p-5 d-flex align-items-center justify-content-center">
        <div class="login-container">
            <!-- Title section -->
            <div class="mb-5">
                <h1 class="display-5 fw-bold text-navy">RESERVA</h1>
                <h2 class="display-6 text-navy">CENTROS DEPORTIVOS</h2>
            </div>

            <!-- Login form -->
            <form method="POST" action="{{ route('login') }}" class="mt-4">
                @csrf
                
                <!-- Login message -->
                <p class="text-muted mb-4">Antes de ingresar debe estar registrado.</p>

                <!-- Username/RUT field -->
                <div class="form-group mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control py-2" 
                               name="username" 
                               placeholder="Ingresar rut sin puntos y con guión"
                               required>
                        <span class="input-group-text">
                            <i class="fas fa-user"></i> <!-- // Comentario: Aquí va el ícono de usuario -->
                        </span>
                    </div>
                </div>

                <!-- Password field -->
                <div class="form-group mb-4">
                    <div class="input-group">
                        <input type="password" class="form-control py-2" 
                               name="password" 
                               placeholder="Contraseña"
                               required>
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i> <!-- // Comentario: Aquí va el ícono de candado -->
                        </span>
                    </div>
                </div>

                <!-- Login button -->
                <button type="submit" class="btn btn-primary w-100 py-2 mb-3">
                    Ingresar
                </button>

                <!-- Forgot password link -->
                <div class="text-center">
                    <a href="#" class="text-primary text-decoration-none">¿Olvidaste tu contraseña?</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Right column for images -->
    <div class="col-md-8 d-flex justify-content-center align-items-center bg-light p-4 position-relative"> <!-- Añadido position-relative -->
        <!-- Logo en la esquina superior izquierda -->
        <div class="position-absolute top-0 start-0 p-3"> <!-- Contenedor del logo -->
            <img src="{{ asset('imagenes/logo-las-condes.png') }}" alt="Logo Las Condes" class="img-fluid" style="max-width: 100px;"> <!-- Ajusta el tamaño del logo -->
        </div>

        <!-- Imagen de portada -->
        <img src="{{ asset('imagenes/portada.jpg') }}" alt="Imagen de portada" class="img-fluid rounded shadow img-custom">
    </div>
</div>

<style>
    .text-navy {
        color: #2A2859;
    }

    .btn-primary {
        background-color: #2A2859;
        border-color: #2A2859;
    }

    .btn-primary:hover {
        background-color: #1e1d40;
        border-color: #1e1d40;
    }

    .img-custom {
        max-width: 80%; /* La imagen no ocupará más del 80% del ancho disponible */
        max-height: 90vh; /* Altura máxima del 80% de la pantalla */
        object-fit: contain; /* Mantiene la proporción de la imagen sin recortarla */
        border-radius: 10px; /* Bordes redondeados */
    }

</style>