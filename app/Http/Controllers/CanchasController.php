<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
            // $validatedData = $request->validate([
            //     'fecha_reserva' => 'required|date|after_or_equal:today',
            //     'horario' => 'required|in:08:00,09:00,10:00,11:00,12:00,13:00,14:00,15:00,16:00,17:00,18:00,19:00,20:00'
            // ]);
    
            // Lógica de creación de reserva 
            $reserva = Reserva::create([
                'usuario_id' => auth()->id(),
                'cancha_id' => 1, // Esto debería venir del formulario
                'fecha_reserva' => 'fecha_reserva',
                'horario' => 'horario',
                // 'fecha_reserva' => $validatedData['fecha_reserva'],
                // 'horario' => $validatedData['horario'],
                'estado' => 'activo'
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Reserva creada exitosamente',
                'reserva' => $reserva
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear la reserva:' . $e->getMessage()
            ], 400);
        }
    }
        

}