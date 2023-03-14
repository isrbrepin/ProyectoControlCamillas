<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('salas')->insert([
            [
                'medico_id' => 1,
                'paciente_id' => 1,
                'fecha_hora_inicio' => '2023-02-30 10:15:00',
                'planta' => "3",
                'numero_sala' => "135",
            ],
            [
                'medico_id' => 1,
                'paciente_id' => 2,
                'fecha_hora_inicio' => '2023-01-30 09:30:00',
                'planta' => "1",
                'numero_sala' => "45",
            ],
            [
                'medico_id' => 2,
                'paciente_id' => 2,
                'fecha_hora_inicio' => '2023-02-15 11:30:00',
                'planta' => "2",
                'numero_sala' => "99",
            ],
        ]);


        DB::table('sala_medicamento')->insert([
            [
                'sala_id' => 1,
                'medicamento_id' => 1,
                'inicio' => '2021-05-31',
                'fin' => '2021-06-07',
                'tomas_dia' => 3,
                'comentarios' => 'Tomar después de las comidas',
            ],
            [
                'sala_id' => 2,
                'medicamento_id' => 2,
                'inicio' => '2021-06-30',
                'fin' => '2021-07-15',
                'tomas_dia' => 2,
                'comentarios' => 'El paciente presenta reacciones alérgicas',
            ],
            [
                'sala_id' => 2,
                'medicamento_id' => 1,
                'inicio' => '2021-06-30',
                'fin' => '2021-07-10',
                'tomas_dia' => 1,
                'comentarios' => 'Se especifica la toma',
            ],
        ]);
    }
}
