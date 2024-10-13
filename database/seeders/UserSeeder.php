<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        /*
            * System Roles

                - administrador
                - cajero
        */

        User::create([
            'name' => 'Don Agave',
            'apellidos' => 'Restaurante',
            'email' => 'administrador@gmail.com',
            'password' => bcrypt('holamundo'),
            'role' => 'administrador',
            'turno' => 'Completo',
            'expiracion' => '2026-12-12 00:00:00',
        ]);

        User::create([
            'name' => 'Cajero',
            'apellidos' => 'Base',
            'email' => 'cajero@gmail.com',
            'password' => bcrypt('holamundo'),
            'role' => 'cajero',
            'turno' => 'Completo',
            'expiracion' => '2026-12-12 00:00:00',
        ]);

    }
}
