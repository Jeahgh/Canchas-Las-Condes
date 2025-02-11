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
            DB::beginTransaction();
    
            $fechaReserva = $request->input('fecha_reserva');
            $idHora = $request->input('horario');
    
            $idCancha = $this->buscarCanchaDisponible($fechaReserva, $idHora);
    
            if (!$idCancha) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay canchas disponibles'
                ], 400);
            }
    
            $reserva = Reserva::create([
                'id_usuario' => auth()->id(),
                'id_cancha' => $idCancha,
                'fecha_reserva' => $fechaReserva,
                'estado' => 1,
                'codigo_disponibilidad' => $idHora
            ]);
    
            $disponibilidad = DisponibilidadCanchas::find($idHora);
            $columna = "cancha_" . $idCancha;
            $disponibilidad->$columna = 0;
            $disponibilidad->save();
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Reserva creada exitosamente',
                'cancha' => $idCancha
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 400);
        }
    }

    public function getHorasDisponibles(Request $request)
    {
        $fecha = $request->input('fecha');
    
        $horasDisponibles = DisponibilidadCanchas::where('fecha', $fecha)
            ->where(function($query) {
                $query->where('cancha_1', 1)
                      ->orWhere('cancha_2', 1)
                      ->orWhere('cancha_3', 1);
            })
            ->select('id', 'hora')
            ->get()
            ->map(function ($disponibilidad) {
                return [
                    'hora' => $disponibilidad->id,
                    'rango' => $disponibilidad->hora
                ];
            });
    
        return response()->json($horasDisponibles);
    }

    private function buscarCanchaDisponible($fecha, $idDisponibilidad)
    {
        // Obtener el registro de disponibilidad
        $disponibilidad = DisponibilidadCanchas::find($idDisponibilidad);
        if (!$disponibilidad) {
            return null;
        }
    
        // Obtener canchas ya reservadas
        $reservasExistentes = Reserva::where('codigo_disponibilidad', $idDisponibilidad)
            ->pluck('id_cancha');
    
        // Buscar la primera cancha disponible considerando los flags
        for ($cancha = 1; $cancha <= 3; $cancha++) {
            // Verificar si la cancha está habilitada según el flag
            if (!$disponibilidad["cancha_$cancha"]) {
                continue;
            }
    
            // Verificar si ya está reservada
            if ($reservasExistentes->contains($cancha)) {
                continue;
            }
    
            return $cancha;
        }
    
        return null;
    }

    public function generarComprobante(Request $request)
    {
        return view('comprobante', [
            'fecha' => $request->query('fecha'),
            'hora' => $request->query('hora'),
            'cancha' => $request->query('cancha')
        ]);
    }

}