<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\DisponibilidadCanchas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CanchasController extends Controller
{
    public function index(Request $request)
    {
        setlocale(LC_TIME, 'es_ES.UTF-8');
        Carbon::setLocale('es');
        $fecha = $request->input('fecha') ? Carbon::parse($request->input('fecha')) : Carbon::now();
        $calendario = $this->generarCalendario($fecha);
        
        return view('canchas', [
            'fecha' => $fecha, // Mantén el objeto Carbon completo
            'calendario' => $calendario,
            'mesAnterior' => $fecha->copy()->subMonth()->format('Y-m'),
            'mesSiguiente' => $fecha->copy()->addMonth()->format('Y-m'),
        ]);
    }

    private function generarCalendario($fecha)
    {
        $primerDia = $fecha->copy()->startOfMonth();
        $ultimoDia = $fecha->copy()->endOfMonth();
        
        $calendario = [];
        $diaActual = $primerDia->copy();
        
        // Ajustar para que la semana comience en lunes
        $offset = ($primerDia->dayOfWeek == 0) ? 6 : $primerDia->dayOfWeek - 1;
    
        // Agregar días vacíos al inicio
        for ($i = 0; $i < $offset; $i++) {
            $calendario[] = null;
        }
        
        // Agregar días del mes
        while ($diaActual <= $ultimoDia) {
            $calendario[] = $diaActual->copy();
            $diaActual->addDay();
        }
        
        // Agregar días vacíos al final para completar la última semana
        $diasRestantes = (7 - count($calendario) % 7) % 7;
        for ($i = 0; $i < $diasRestantes; $i++) {
            $calendario[] = null;
        }
        
        return $calendario;
    }

    public function create(Request $request)
    {
        try {
            // Obtener fecha y código de hora
            $fechaReserva = $request->input('fecha_reserva');
            $idHora = $request->input('horario');
    
            // Buscar cancha disponible
            $idCancha = $this->buscarCanchaDisponible($fechaReserva, $idHora);
    
            if (!$idCancha) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay canchas disponibles'
                ], 400);
            }
    
            // Obtener detalles del horario
            $horarioDetalle = DisponibilidadCanchas::where('fecha', $fechaReserva)
                ->where('id_hora', $idHora)
                ->first();
    
            // Crear reserva
            $reserva = Reserva::create([
                'id_usuario' => auth()->id(),
                'id_cancha' => $idCancha,
                'fecha_reserva' => $fechaReserva,
                'estado' => 1, // Estado activo
                'codigo_disponibilidad' => $idHora
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Reserva creada exitosamente'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }

    public function getHorasDisponibles(Request $request)
    {
        $fecha = $request->input('fecha');
    
        $reservasExistentes = Reserva::where('fecha_reserva', $fecha)
            ->select('hora', 'id_cancha')
            ->get();
    
        $disponibilidadEspecial = DisponibilidadCanchas::where('fecha', $fecha)
            ->get()
            ->keyBy('id_hora');
    
        $horasDisponibles = [];
        
        // Fetch horarios from database instead of hardcoded array
        $horariosDisponibles = DisponibilidadCanchas::where('fecha', $fecha)
            ->select('id_hora', 'hora')
            ->distinct()
            ->get();
    
        foreach ($horariosDisponibles as $horario) {
            $algunaCanchaDisponible = false;
            
            for ($cancha = 1; $cancha <= 3; $cancha++) {
                $reservada = $reservasExistentes
                    ->where('hora', $horario->id_hora)
                    ->where('id_cancha', $cancha)
                    ->isNotEmpty();
                
                $disponible = isset($disponibilidadEspecial[$horario->id_hora]) 
                    ? $disponibilidadEspecial[$horario->id_hora]["cancha_$cancha"] 
                    : true;
                
                if (!$reservada && $disponible) {
                    $algunaCanchaDisponible = true;
                    break;
                }
            }
            
            if ($algunaCanchaDisponible) {
                $horasDisponibles[] = [
                    'hora' => $horario->id_hora,
                    'rango' => $horario->hora
                ];
            }
        }
    
        return response()->json($horasDisponibles);
    }

    private function buscarCanchaDisponible($fecha, $hora){
        // Buscar reservas existentes para esta fecha y hora
        $reservasExistentes = Reserva::where('fecha_reserva', $fecha)
            ->where('hora', $hora)
            ->pluck('id_cancha');
    
        // Verificar disponibilidad especial
        $disponibilidadEspecial = DisponibilidadCanchas::where('fecha', $fecha)
            ->where('hora', $hora)
            ->first();
    
        // Buscar la primera cancha disponible
        for ($cancha = 1; $cancha <= 3; $cancha++) {
            // Verificar si ya está reservada
            if ($reservasExistentes->contains($cancha)) {
                continue;
            }
    
            // Verificar disponibilidad especial
            if ($disponibilidadEspecial && !$disponibilidadEspecial["cancha_$cancha"]) {
                continue;
            }
    
            return $cancha;
        }
    
        return null;
    }

}