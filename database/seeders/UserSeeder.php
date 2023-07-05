<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {

        User::create([
            'name' => 'Victor Gabriel',
            'apellidos' => 'Valencia Garcia',
            'email' => 'desarrollador@gmail.com',
            'password' => bcrypt('holamundo'),
            'role' => 'desarrollador',
            'turno' => 'Matutino',
            'expiracion' => '2024-12-12 00:00:00',
        ]);

        User::create([
            'name' => 'Saul Usiel',
            'apellidos' => 'Luis Lopez',
            'email' => 'administrador@gmail.com',
            'password' => bcrypt('holamundo'),
            'role' => 'administrador',
            'turno' => 'Vespertino',
            'expiracion' => '2024-12-12 00:00:00',
        ]);

        User::create([
            'name' => 'Emilli',
            'apellidos' => 'Rodriguez Retes',
            'email' => 'cajero@gmail.com',
            'password' => bcrypt('holamundo'),
            'role' => 'cajero',
            'turno' => 'Completo',
            'expiracion' => '2024-12-12 00:00:00',
        ]);

        User::create([
            'name' => 'Amelia',
            'apellidos' => 'Dyer Grese',
            'email' => 'gerente@gmail.com',
            'password' => bcrypt('holamundo'),
            'role' => 'gerente',
            'turno' => 'Matutino',
            'expiracion' => '2024-12-12 00:00:00',
        ]);

        User::create([
            'name' => 'Luz Belatrix',
            'apellidos' => 'Sorenson',
            'email' => 'recepcionista@gmail.com',
            'password' => bcrypt('holamundo'),
            'role' => 'recepcionista',
            'turno' => 'Vespertino',
            'expiracion' => '2024-12-12 00:00:00',
        ]);
    }
}
