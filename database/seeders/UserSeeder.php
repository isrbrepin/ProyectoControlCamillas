<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => "Administrador",
                'dni' => "12345678A"
                'email' => "administrador@administrador.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "Antonio Ramos",
                'dni' => "12345678B"
                'email' => "medico1@medico.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "Marcos Manzano",
                'dni' => "12345678C"
                'email' => "medico2@medico.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "Pedro Lopez",
                'dni' => "12345678D"
                'email' => "paciente1@paciente.com",
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => "Fernando Alonso",
                'dni' => "12345678E"
                'email' => "paciente2@paciente.com",
                'password' => Hash::make('12345678'),
            ],
        ]);
    }
}
