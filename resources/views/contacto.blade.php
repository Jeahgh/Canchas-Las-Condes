@extends('layouts.app')
 
@section('content')
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card border-0 shadow">
                        <div class="row g-0">
                            <div class="col-md-6">
                                <div class="card-body p-5">
                                    <h2 class="card-title mb-4">Contáctanos</h2>
                                    <form action="#" method="POST">
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
                                        
                                        <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6 bg-primary text-white d-flex align-items-center">
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
        </div>
    </div>
@endsection