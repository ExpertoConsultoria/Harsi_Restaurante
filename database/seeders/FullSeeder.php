<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Calendar;
use App\Models\CategoriaProducto;
use App\Models\DescuentoUsuario;
use App\Models\Estado;
use App\Models\Horario;
use App\Models\Mesa;
use App\Models\PayMethod;
use App\Models\Restaurante;

class FullSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Categorias */
            CategoriaProducto::create([
                'titulo' => 'Entradas',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Ensaladas',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Sopas',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Pastas',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Postres',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Comidas',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Pan',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Omelettes',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Hamburguesas',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Sandwiches',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Tortas',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Del Comal',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Desayunos',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Producto Especial',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Cocteles',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Ron',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Vodka',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Ginebra',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Tequila',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Whiskey',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Entradas',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Vino',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Cerveza',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Bebidas',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Brandy',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Artesanal',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Mezcal',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Otras Bebidas',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Fruta',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Extras',
            ]);
            CategoriaProducto::create([
                'titulo' => 'Comida',
            ]);

        /* Descuentos de Usuario */
            DescuentoUsuario::create([
                'role' => 'Desarrollador',
                'descuento' => 0,
            ]);
            DescuentoUsuario::create([
                'role' => 'Administrador',
                'descuento' => 50,
            ]);
            DescuentoUsuario::create([
                'role' => 'Cajero',
                'descuento' => 10,
            ]);

        /* Status */
            Estado::create([
                'titulo' => 'Abierto',
            ]);
            Estado::create([
                'titulo' => 'Cerrada',
            ]);

        /* Horario */
            Horario::create([
                'turno' => 'Matutino',
                'fecha_ini' => '08:00:00',
                'fecha_fin' => '16:00:00',
            ]);
            Horario::create([
                'turno' => 'Vespertino',
                'fecha_ini' => '11:00:00',
                'fecha_fin' => '19:00:00',
            ]);
            Horario::create([
                'turno' => 'Completo',
                'fecha_ini' => '08:00:00',
                'fecha_fin' => '19:00:00',
            ]);

        /* Mesas */
            Mesa::create([
                'titulo' => 'Para llevar',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);
            Mesa::create([
                'titulo' => 'Mesa 1',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);
            Mesa::create([
                'titulo' => 'Mesa 2',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);
            Mesa::create([
                'titulo' => 'Mesa 3',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);
            Mesa::create([
                'titulo' => 'Mesa 4',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);
            Mesa::create([
                'titulo' => 'Mesa 5',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);
            Mesa::create([
                'titulo' => 'Mesa 6',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);
            Mesa::create([
                'titulo' => 'Mesa 7',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);
            Mesa::create([
                'titulo' => 'Uber',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);
            Mesa::create([
                'titulo' => 'Rappi',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);
            Mesa::create([
                'titulo' => 'Didi',
                'estado' => 'Cerrada',
                'color' => '#008000',
            ]);

        /* Metodos de Pago */
            PayMethod::create([
                'titulo' => 'Efectivo',
            ]);
            PayMethod::create([
                'titulo' => 'Tarjeta de Debito',
            ]);
            PayMethod::create([
                'titulo' => 'Tarjeta de Credito',
            ]);
            PayMethod::create([
                'titulo' => 'Deposito',
            ]);
            PayMethod::create([
                'titulo' => 'Transferencia',
            ]);

        /* Restaurante */
            Restaurante::create([
                'nombre' => 'RAME COCINA TRADICIONAL',
                'rfc' => 'PAEF891108L41',
                'direccion' => 'CALLE CAMINO NACIONAL 106 SAN SEBASTIAN TUTLA',
                'telefono' => '9511969373',
                'email' => 'ramecocina@gmail.com',
                'subcategoria' => 'No',
                'reducir' => 'No',
                'hotel' => 'No',
                'facebook' => null,
                'instagram' => null,
                'twitter' => null,
                'youTube' => null,
                'linkedIn' => null,
            ]);

    }
}
