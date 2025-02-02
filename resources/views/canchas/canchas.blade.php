@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <!-- Título Principal -->
    <h1 class="text-center mb-4 text-primary fw-bold">Reserva de Canchas</h1>

    <!-- Imagen principal -->
    <div class="text-center mb-4">
        <img src="{{ asset('imagenes/tenis.png') }}" alt="Reserva Canchas" 
             class="img-fluid rounded shadow-lg" 
             style="max-height: 300px; object-fit: cover; width: 100%;">
    </div>

    <!-- Sección de Disponibilidad -->
    <div class="card shadow-lg mb-5">
        <div class="card-header bg-primary text-white py-3">
            <h2 class="h4 text-center mb-0">Disponibilidad</h2>
        </div>
        <div class="card-body">
            <!-- Navegación del calendario -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <button class="btn btn-outline-primary">
                    <i class="fas fa-chevron-left"></i> Mes anterior
                </button>
                <h3 class="mb-0">Febrero 2025</h3>
                <button class="btn btn-outline-primary">
                    Mes siguiente <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Calendario -->
            <div class="calendar">
                <!-- Días de la semana -->
                <div class="row text-center fw-bold border-bottom py-2 bg-light">
                    <div class="col">Dom</div>
                    <div class="col">Lun</div>
                    <div class="col">Mar</div>
                    <div class="col">Mié</div>
                    <div class="col">Jue</div>
                    <div class="col">Vie</div>
                    <div class="col">Sáb</div>
                </div>

                <!-- Días del mes -->
                <div class="row row-cols-7 text-center">
                    @for ($i = 1; $i <= 31; $i++)
                        <div class="col p-2 border position-relative" style="height: 100px;">
                            <span class="position-absolute top-0 start-0 p-1">{{ $i }}</span>
                            <button class="btn btn-sm btn-outline-success position-absolute bottom-0 start-50 translate-middle-x mb-1"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#reservationModal">
                                Reservar
                            </button>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para reservaciones -->
    <div class="modal fade" id="reservationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Hacer Reservación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Horario Disponible</label>
                            <select class="form-select">
                                <option>08:00 - 09:00</option>
                                <option>09:00 - 10:00</option>
                                <option>10:00 - 11:00</option>
                                <!-- Más horarios... -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cancha</label>
                            <select class="form-select">
                                <option>Cancha 1</option>
                                <option>Cancha 2</option>
                                <option>Cancha 3</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Confirmar Reserva</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estilos adicionales -->
<style>
.calendar .col {
    min-width: 100px;
}

.calendar .row-cols-7 > * {
    width: 14.285714%;
}

.btn-outline-success:hover {
    background-color: #198754;
    color: white;
}
</style>
@endsection