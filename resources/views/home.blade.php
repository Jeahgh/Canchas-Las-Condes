@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="container-fluid px-0">
        <div class="position-relative">
            <img src="{{ asset('imagenes/parque.png') }}" class="w-100" style="height: 500px; object-fit: cover;" alt="Parque Araucano">
            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.4);">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bold">Parque Araucano</h1>
                    <p class="lead">Tu espacio deportivo en Las Condes</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Activities Gallery Section -->
    <div class="container my-5">
        <h2 class="text-center mb-5">Actividades Deportivas</h2>
        <div id="actividadesCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row g-0">
                        <div class="col-md-6 p-2">
                            <div class="position-relative overflow-hidden activity-card" style="height: 400px;">
                                <img src="{{ asset('imagenes/basketball.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="Basketball">
                                <div class="position-absolute bottom-0 start-0 w-100 p-3 text-white" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                    <h3 class="h4">Basketball</h3>
                                    <p class="mb-0">Canchas profesionales para todos los niveles</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row g-0">
                                <div class="col-6 p-2">
                                    <div class="position-relative overflow-hidden activity-card" style="height: 195px;">
                                        <img src="{{ asset('imagenes/tenis.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="Tenis">
                                        <div class="position-absolute bottom-0 start-0 w-100 p-2 text-white" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                            <h3 class="h6">Tenis</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 p-2">
                                    <div class="position-relative overflow-hidden activity-card" style="height: 195px;">
                                        <img src="{{ asset('imagenes/volley.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="Volley">
                                        <div class="position-absolute bottom-0 start-0 w-100 p-2 text-white" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                            <h3 class="h6">Volley</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 p-2">
                                    <div class="position-relative overflow-hidden activity-card" style="height: 195px;">
                                        <img src="{{ asset('imagenes/skate.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="Skate">
                                        <div class="position-absolute bottom-0 start-0 w-100 p-2 text-white" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                            <h3 class="h6">Skate Park</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 p-2">
                                    <div class="position-relative overflow-hidden activity-card" style="height: 195px;">
                                        <img src="{{ asset('imagenes/bike.jpg') }}" class="w-100 h-100" style="object-fit: cover;" alt="Bike Park">
                                        <div class="position-absolute bottom-0 start-0 w-100 p-2 text-white" style="background: linear-gradient(transparent, rgba(0,0,0,0.7));">
                                            <h3 class="h6">Bike Park</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <h2 class="text-center mb-5">Descubre Todo lo que el Parque Araucano Tiene para Ti</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="text-center">
                        <i class="fas fa-medal fa-3x mb-3" style="color: #181f47;"></i>
                        <h3 class="h5">Espacios de Calidad</h3>
                        <p>Infraestructura deportiva moderna con mantenimiento permanente</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <i class="fas fa-calendar-check fa-3x mb-3" style="color: #181f47;"></i>
                        <h3 class="h5">Reserva Tu Cancha</h3>
                        <p>Agenda tu hora de tenis fácilmente a través de nuestro sistema en línea</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <i class="fas fa-map-marker-alt fa-3x mb-3" style="color: #181f47;"></i>
                        <h3 class="h5">Conectividad</h3>
                        <p>A pasos del Metro Manquehue y principales avenidas de Las Condes</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <i class="fas fa-clock fa-3x mb-3" style="color: #181f47;"></i>
                        <h3 class="h5">Horarios</h3>
                        <p>Disfruta del parque los 7 días de la semana</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedule Section -->
    <div class="container my-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h3 class="text-center mb-4">Horarios de Atención</h3>
                <div class="row text-center">
                    <div class="col-md-6">
                        <h4 class="h6">Lunes a Viernes</h4>
                        <p style="color: #181f47;">07:00 - 21:00 hrs</p>
                    </div>
                    <div class="col-md-6">
                        <h4 class="h6">Sábados y Domingos</h4>
                        <p style="color: #181f47;">08:00 - 20:00 hrs</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .carousel-item {
            transition: transform 1.5s ease-in-out;
        }
        
        .activity-card img {
            transition: transform 0.3s ease-in-out;
        }
        
        .activity-card:hover img {
            transform: scale(1.05);
        }
    </style>
@endsection