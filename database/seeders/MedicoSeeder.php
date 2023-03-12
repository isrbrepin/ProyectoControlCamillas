<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MedicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medicos')->insert([
            [
                'telefono' => "956123456",
                'fecha_nacimiento' => "1975-01-01",
                'fecha_contratacion' => "2021-01-01",
                'vacunado' => 1,
                'sueldo' => 40000.0,
                'user_id' => 2,
                'especialidad_id' => 2
            ],
            [
                'telefono' => "856987654"
                'fecha_nacimiento' => "1976-05-21",
                'fecha_contratacion' => "2020-06-01",
                'vacunado' => 0,
                'sueldo' => 50000.0,
                'user_id' => 3,
                'especialidad_id' => 3
            ],
        ]);
    }
}
