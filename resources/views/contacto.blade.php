@extends('layouts.app')
 
@section('content')
    <div class="container-fluid py-4"> <!-- Reduje el padding vertical -->
        <div class="container-fluid px-4"> <!-- Añadí padding horizontal y quité el contenedor extra -->
            <div class="card border-0 shadow">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="card-body p-5">
                            <h2 class="card-title mb-4">Contáctanos</h2>
                            <form action="{{ route('contacto.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="tipo_solicitud" class="form-label">Tipo de Solicitud</label>
                                    <select class="form-select" id="tipo_solicitud" name="tipo_solicitud" required>
                                        <option value="">Seleccione un tipo</option>
                                        <option value="consulta">Consulta General</option>
                                        <option value="problema">Problema con Reserva</option>
                                        <option value="sugerencia">Sugerencia</option>
                                        <option value="reclamo">Reclamo</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="mensaje" class="form-label">Mensaje</label>
                                    <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
                                </div>
                                
                                <button type="submit" class="btn text-white" style="background-color: #181f47;">Enviar Mensaje</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 text-white" style="background-color: #181f47;"> <!-- Cambié el color a el azul corporativo -->
                        <div class="p-5">
                            <h3 class="mb-4">Información de Contacto</h3>
                            <div class="mb-4">
                                <i class="fas fa-map-marker-alt me-2"></i>
                                <span>Parque Araucano, Las Condes, Santiago</span>
                            </div>
                            <div class="mb-4">
                                <i class="fas fa-phone me-2"></i>
                                <span>+56 2 2840 0000</span>
                            </div>
                            <div class="mb-4">
                                <i class="fas fa-envelope me-2"></i>
                                <span>deportes@lascondes.cl</span>
                            </div>
                            <div class="mt-5">
                                <h4 class="h5 mb-3">Horario de Atención</h4>
                                <p class="mb-1">Lunes a Viernes: 8:00 - 20:00</p>
                                <p>Sábados y Domingos: 9:00 - 18:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-tennis-ball me-2"></i>Nuestras Canchas</h4>
                        <p>Contamos con 8 canchas profesionales de tenis con iluminación LED y superficie de primer nivel.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-calendar-alt me-2"></i>Reservas</h4>
                        <p>Sistema de reservas online disponible las 24 horas. Reserve su cancha con hasta 7 días de anticipación.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body">
                        <h4 class="card-title"><i class="fas fa-star me-2"></i>Servicios</h4>
                        <p>Vestuarios, estacionamiento gratuito, cafetería y tienda de artículos deportivos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        /* Asegurar que el formulario ocupe todo el alto disponible */
        .card {
            margin: 0;
            height: calc(100vh - 100px); /* Altura total menos el espacio del header */
        }
        
        /* Asegurar que las columnas tengan el mismo alto */
        .row {
            height: 100%;
        }
        
        /* Estilo para los inputs y select */
        .form-control, .form-select {
            border-radius: 4px;
            border: 1px solid #ced4da;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #181f47;
            box-shadow: 0 0 0 0.2rem rgba(24, 31, 71, 0.25);
        }
        
        /* Estilo para el botón */
        .btn:hover {
            opacity: 0.9;
        }
    </style>
@endsection