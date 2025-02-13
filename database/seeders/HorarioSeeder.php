<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Horario;

class HorarioSeeder extends Seeder
{
    public function run()
    {
        $horarios = [
            ['id' => 8, 'hora' => '8:00 - 9:00'],
            ['id' => 9, 'hora' => '9:00 - 10:00'],
            ['id' => 10, 'hora' => '10:00 - 11:00'],
            ['id' => 11, 'hora' => '11:00 - 12:00'],
            ['id' => 12, 'hora' => '12:00 - 13:00'],
            ['id' => 13, 'hora' => '13:00 - 14:00'],
            ['id' => 14, 'hora' => '14:00 - 15:00'],
            ['id' => 15, 'hora' => '15:00 - 16:00'],
            ['id' => 16, 'hora' => '16:00 - 17:00'],
            ['id' => 17, 'hora' => '17:00 - 18:00'],
            ['id' => 18, 'hora' => '18:00 - 19:00'],
            ['id' => 19, 'hora' => '19:00 - 20:00'],
            ['id' => 20, 'hora' => '20:00 - 21:00'],
        ];

        foreach ($horarios as $horario) {
            Horario::create($horario);
        }
    }
}