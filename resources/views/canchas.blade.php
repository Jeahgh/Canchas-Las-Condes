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
                <h3 class="mb-0">{{ mb_strtoupper($fecha->translatedFormat('F'), 'UTF-8') }}</h3>
                <a href="{{ route('canchas.index', ['fecha' => $mesSiguiente]) }}" 
                   class="btn btn-outline-primary">
                    Mes siguiente <i class="fas fa-chevron-right"></i>
                </a>
            </div>
            <div class="calendar">
                <div class="row text-center fw-bold border-bottom py-2 bg-light">

                    <div class="col">Lun</div>
                    <div class="col">Mar</div>
                    <div class="col">Mié</div>
                    <div class="col">Jue</div>
                    <div class="col">Vie</div>
                    <div class="col">Sáb</div>
                    <div class="col">Dom</div>

                </div>
            
                <div class="row">
                    @php 
                        $counter = 0; 
                        $today = now()->format('Y-m-d');
                        $startOfWeek = now()->startOfWeek()->format('Y-m-d');
                        $endOfWeek = now()->endOfWeek()->format('Y-m-d');
                    @endphp
                    @foreach($calendario as $dia)
                        @if($counter % 7 == 0)
                            </div><div class="row">
                        @endif
                        <div class="col p-2 border position-relative {{ $dia && $dia->format('Y-m-d') == $today ? 'dia-actual' : '' }}" style="height: 100px;">
                            @if($dia)
                                <span class="position-absolute top-0 start-0 p-1">{{ $dia->day }}</span>
                                
                                @php
                                    $isDiaHabilitado = $dia && 
                                        $dia->format('Y-m-d') >= $today &&
                                        $dia->format('Y-m-d') >= $startOfWeek && 
                                        $dia->format('Y-m-d') <= $endOfWeek;
                                @endphp
                                
                                @if($isDiaHabilitado)
                                    <button class="btn btn-sm {{ $isDiaHabilitado ? 'btn-reserva-habilitado' : 'btn-outline-secondary' }} position-absolute bottom-0 start-50 translate-middle-x mb-1"
                                        data-bs-toggle="modal" 
                                        data-bs-target="#reservationModal"
                                        data-fecha="{{ $dia->format('Y-m-d') }}">
                                        Reservar
                                    </button>
                                @else
                                    <button class="btn btn-sm btn-outline-secondary position-absolute bottom-0 start-50 translate-middle-x mb-1"
                                        disabled>
                                        Reservar
                                    </button>
                                @endif
                            @endif
                        </div>
                        @php $counter++; @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Reserva-->
    <div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservationModalLabel">Generar Reserva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="reservaForm" onsubmit="crearReserva(event)">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fecha_reserva" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha_reserva" name="fecha_reserva" readonly disabled>
                        </div>
                        <div class="mb-3">
                            <label for="horario" class="form-label">Horario</label>
                            <select class="form-select" id="horario" name="horario" required>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn text-white bg-custom-blue">Reservar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Abrir y cerrar el modal AGREGAR
    function openModalAgregar() {
        document.getElementById("ReservaModal").style.display = "block";
    }
    function closeModalAgregar() {
        document.getElementById("ReservaModal").style.display = "none";
        document.getElementById("reservaForm").reset();
    }



    async function crearReserva(event) {
        event.preventDefault();
        
        const fecha = document.getElementById('fecha_reserva').value;
        const horario = document.getElementById('horario').value;
        
        try {
            const response = await axios.post('{{ route("reservas.create") }}', {
                fecha_reserva: fecha,
                horario: horario
            });
            
            $('#reservationModal').modal('hide');
            alert(response.data.message);
            location.reload(); // Actualizar página
        } catch (error) {
            alert(error.response?.data?.message || "Error al crear reserva");
        }
    }


    // Script para cargar horas disponibles dinámicamente
    document.addEventListener('DOMContentLoaded', function() {
        const reservationModal = document.getElementById('reservationModal');
        const horaSelect = document.getElementById('horario');
        
        reservationModal.addEventListener('show.bs.modal', function(event) {
            // Obtener la fecha seleccionada
            const button = event.relatedTarget;
            const fecha = button.getAttribute('data-fecha');
            document.getElementById('fecha_reserva').value = fecha;
            
            // Limpiar opciones anteriores
            horaSelect.innerHTML = '';
            
            // Llamar al endpoint para obtener horas disponibles
            axios.get(`/horas-disponibles?fecha=${fecha}`)
                .then(response => {
                    const horasDisponibles = response.data;
                    
                    // Generar opciones solo para horas disponibles
                    horasDisponibles.forEach(hora => {
                        const option = document.createElement('option');
                        option.value = hora.hora;  // Valor numérico de la hora
                        option.textContent = hora.rango;  // Texto descriptivo
                        horaSelect.appendChild(option);
                    });
                    
                    // Si no hay horas disponibles
                    if (horasDisponibles.length === 0) {
                        const option = document.createElement('option');
                        option.textContent = 'No hay horas disponibles';
                        option.disabled = true;
                        horaSelect.appendChild(option);
                    }
                })
                .catch(error => {
                    console.error('Error al cargar horas disponibles:', error);
                    const option = document.createElement('option');
                    option.textContent = 'Error al cargar horas';
                    option.disabled = true;
                    horaSelect.appendChild(option);
                });
        });
    });

    // Agregar este script después de tu script existente
    document.addEventListener('DOMContentLoaded', function() {
        // Obtener el modal
        const reservationModal = document.getElementById('reservationModal');
        
        // Agregar evento para cuando el modal se muestre
        reservationModal.addEventListener('show.bs.modal', function(event) {
            // Obtener el botón que activó el modal
            const button = event.relatedTarget;
            
            // Obtener la fecha del atributo data-fecha del botón
            const fecha = button.getAttribute('data-fecha');
            
            // Obtener el input de fecha dentro del modal
            const fechaInput = document.getElementById('fecha_reserva');
            
            // Establecer el valor del input con la fecha seleccionada
            fechaInput.value = fecha;
        });
    });

</script>

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

    
    .dia-actual {
        background-color: rgba(40, 167, 69, 0.1); /* Verde muy suave */
        border: 1px solid rgba(40, 167, 69, 0.3); /* Borde verde suave */
    }

    .dia-actual span {
        font-weight: bold;
        color: #28a745; /* Verde más intenso */
    }

    .btn-reserva-habilitado {
        color: white !important;
        background-color: #28a745 !important; /* Verde */
        border-color: #28a745 !important;
    }

    .btn-reserva-habilitado:hover {
        background-color: #218838 !important; /* Verde más oscuro */
        border-color: #1e7e34 !important;
    }


            
</style>

@endsection