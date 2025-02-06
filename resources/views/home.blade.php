@extends('layouts.app')
 
@section('content')


    <!-- Features Section -->
    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-calendar-check fa-3x text-primary mb-3"></i>
                        <h3 class="card-title h5">Reservas Online</h3>
                        <p class="card-text">Sistema de reservas disponible 24/7 para tu comodidad</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fa-solid fa-baseball fa-3x text-primary mb-3"></i>
                        <h3 class="card-title h5">Canchas Profesionales</h3>
                        <p class="card-text">Instalaciones de primer nivel para tu mejor juego</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas fa-clock fa-3x text-primary mb-3"></i>
                        <h3 class="card-title h5">Horarios Flexibles</h3>
                        <p class="card-text">Disponibilidad amplia para adaptarnos a tu agenda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Information Section -->
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4">¿Por qué elegir nuestras canchas?</h2>
                    <ul class="list-unstyled">
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> Ubicación privilegiada en el Parque Araucano</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> Mantenimiento profesional diario</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> Sistema de reservas moderno y eficiente</li>
                        <li class="mb-3"><i class="fas fa-check text-primary me-2"></i> Atención personalizada</li>
                    </ul>
                    <a href="#" class="btn btn-outline-primary">Contáctanos</a>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('imagenes/puente.jpg') }}" class="img-fluid rounded shadow" alt="Instalaciones">
                </div>
            </div>
        </div>
    </div>

    <!-- Latest News Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4">Últimas Novedades</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="/api/placeholder/400/200" class="card-img-top" alt="Noticia 1">
                    <div class="card-body">
                        <h5 class="card-title">Nuevo Sistema de Reservas</h5>
                        <p class="card-text">Implementamos un nuevo sistema para hacer tu experiencia más fácil y rápida.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ asset('imagenes/images.jpg') }}" class="card-img-top" alt="Noticia 2">
                    <div class="card-body">
                        <h5 class="card-title">Mantenimiento de Canchas</h5>
                        <p class="card-text">Realizamos mantenimiento periódico para garantizar la mejor calidad de juego.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ asset('imagenes/persona.jpg') }}" class="card-img-top" alt="Noticia 3">
                    <div class="card-body">
                        <h5 class="card-title">Horarios Extendidos</h5>
                        <p class="card-text">Ampliamos nuestros horarios para mayor comodidad de nuestros usuarios.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection