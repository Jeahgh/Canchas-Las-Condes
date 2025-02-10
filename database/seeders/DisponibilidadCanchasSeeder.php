<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DisponibilidadCanchasSeeder extends Seeder
{
    // Define HORARIOS fuera del método run
    private const HORARIOS = [
        '08:00 - 09:00',
        '09:00 - 10:00',
        '10:00 - 11:00',
        '11:00 - 12:00',
        '12:00 - 13:00',
        '13:00 - 14:00',
        '14:00 - 15:00',
        '15:00 - 16:00',
        '16:00 - 17:00',
        '17:00 - 18:00',
        '18:00 - 19:00',
        '19:00 - 20:00',
        '20:00 - 21:00'
    ];

    public function run()
    {
        $fechaInicio = Carbon::now();
        $fechaFin = $fechaInicio->copy()->addDays(6);

        $horarios = [8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];

        while ($fechaInicio <= $fechaFin) {
            foreach ($horarios as $hora) {
                DB::table('disponibilidad_canchas')->insert([
                    'fecha' => $fechaInicio->format('Y-m-d'),
                    'id_hora' => $hora,
                    'hora' => self::HORARIOS[$hora - 8], // Ajusta el índice
                    'cancha_1' => true,
                    'cancha_2' => true,
                    'cancha_3' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            $fechaInicio->addDay();
        }
    }
}