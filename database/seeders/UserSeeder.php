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
                - jefe_meseros
                - jefe_cocina
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

        User::create([
            'name' => 'Jefe de Meseros',
            'apellidos' => 'Base',
            'email' => 'meseros@gmail.com',
            'password' => bcrypt('holamundo'),
            'role' => 'jefe_meseros',
            'turno' => 'Completo',
            'expiracion' => '2026-12-12 00:00:00',
        ]);

        User::create([
            'name' => 'Jefe de Cocina',
            'apellidos' => 'Base',
            'email' => 'cocina@gmail.com',
            'password' => bcrypt('holamundo'),
            'role' => 'jefe_cocina',
            'turno' => 'Completo',
            'expiracion' => '2026-12-12 00:00:00',
        ]);

    }
}
