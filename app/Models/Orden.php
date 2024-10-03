<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    protected $table = 'orden';
    protected $fillable =
        [
        'fecha',
        'mesa',
        'cajero',
        'turno',
        'forma_pago',
        'consumo',
        'cliente',
        'direccion',
        'articulo',
        'comentario',

        'conf_total',
        'descuento',
        'motivo_descuento',
        'descuento_pesos',
        'ordencol',
        'total',
        'propina',
        'total2',
        // 'cupon',
        'pago',
        'cambio',
    ];

    protected $primarykey = 'id';

}
