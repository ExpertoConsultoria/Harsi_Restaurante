<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComandaTemporal extends Model
{
    protected $table = 'comanda_temporal';

    protected $fillable =
    [
        'fila', // Array Index
        'fecha',
        'mesa',
        'estado', // Estado de la Mesa [Abierta, Cerrada]
        'cajero',
        'cliente',
        'direccion',

        'articulo',
        'cantidad',
        'precio_compra',
        'subtotal',
        'status',
        'motivo',
        'comentario',
    ];

    protected $primarykey = 'id';
}
