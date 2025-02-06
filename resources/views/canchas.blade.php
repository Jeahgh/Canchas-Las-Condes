@extends('layouts.app')

@section('content')
<div class="container-calendar">
    <h1 class="text-center mb-4 text-custom-blue fw-bold">Reserva de Canchas</h1>

    <div class="text-center mb-4">
        <img src="{{ asset('imagenes/tenis.png') }}" alt="Reserva Canchas" 
            class="img-fluid rounded shadow-lg" 
            style="max-height: 300px; object-fit: cover; width: 100%;">
    </div>

    <div class="card shadow-lg mb-5">
        <div class="card-header bg-custom-blue text-white py-3">
            <h2 class="h4 text-center mb-0">Disponibilidad</h2>
        </div>
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('canchas.index', ['fecha' => $mesAnterior]) }}" 
                   class="btn btn-outline-primary">
                    <i class="fas fa-chevron-left"></i> Mes anterior
                </a>
                <h3 class="mb-0">{{ $fecha->translatedFormat('F Y') }}</h3>
                <a href="{{ route('canchas.index', ['fecha' => $mesSiguiente]) }}" 
                   class="btn btn-outline-primary">
                    Mes siguiente <i class="fas fa-chevron-right"></i>
                </a>
            </div>
            <div class="calendar">
                <div class="row text-center fw-bold border-bottom py-2 bg-light">
                    <div class="col">Dom</div>
                    <div class="col">Lun</div>
                    <div class="col">Mar</div>
                    <div class="col">Mié</div>
                    <div class="col">Jue</div>
                    <div class="col">Vie</div>
                    <div class="col">Sáb</div>
                </div>
            
                <div class="row">
                    @php $counter = 0; @endphp
                    @foreach($calendario as $dia)
                        @if($counter % 7 == 0)
                            </div><div class="row">
                        @endif
                        <div class="col p-2 border position-relative" style="height: 100px;">
                            @if($dia)
                                <span class="position-absolute top-0 start-0 p-1">{{ $dia->day }}</span>
                                <button class="btn btn-sm btn-outline-success position-absolute bottom-0 start-50 translate-middle-x mb-1"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#reservationModal"
                                        data-fecha="{{ $dia->format('Y-m-d') }}">
                                    Reservar
                                </button>
                            @endif
                        </div>
                        @php $counter++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reservationModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-custom-blue text-white">
                    <h5 class="modal-title">Hacer Reservación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="reservationForm" method="POST" action="{{ route('reservas.store') }}">
                        @csrf
                        <input type="hidden" name="fecha" id="fecha_reserva">
                        <div class="mb-3">
                            <label class="form-label">Horario Disponible</label>
                            <select class="form-select" name="horario" required>
                                @foreach(range(8, 20) as $hora)
                                    <option value="{{ sprintf('%02d:00', $hora) }}">
                                        {{ sprintf('%02d:00', $hora) }} - {{ sprintf('%02d:00', $hora + 1) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cancha</label>
                            <select class="form-select" name="cancha_id" required>
                                <option value="1">Cancha 1</option>
                                <option value="2">Cancha 2</option>
                                <option value="3">Cancha 3</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="reservationForm" class="btn btn-custom-blue">Confirmar Reserva</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --custom-blue: #181f47;
    }

    .text-custom-blue {
        color: var(--custom-blue);
    }

    .bg-custom-blue {
        background-color: var(--custom-blue) !important;
    }

    .btn-custom-blue {
        color: white;
        background-color: var(--custom-blue);
        border-color: var(--custom-blue);
    }

    .btn-custom-blue:hover {
        background-color: rgba(24, 31, 71, 0.8);
        border-color: rgba(24, 31, 71, 0.8);
    }

    .calendar .col {
        min-width: 100px;
    }

    .calendar .row-cols-7 > * {
        width: 14.285714%;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        color: white;
    }

    .btn-outline-primary {
        color: var(--custom-blue) !important;
        border-color: var(--custom-blue) !important;
        background-color: transparent !important;
    }

    .btn-outline-primary:hover {
        background-color: var(--custom-blue) !important;
        color: white !important;
    }

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('reservationModal');
        modal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const fecha = button.getAttribute('data-fecha');
            document.getElementById('fecha_reserva').value = fecha;
        });
    });
</script>

@endsection