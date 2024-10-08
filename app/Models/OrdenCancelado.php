<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenCancelado extends Model
{
    protected $table = 'orden_cancelado';

    protected $fillable =
    [
        'fecha', // Fecha de Guardado
        'mesa', // Mesa Atendida
        'cajero', // Nombre del Cajero

        'guia', // Nombre del Guia
        'mesero', // Nombre del Mesero
        'num_comensales', // Cantidad de Comensales

        'cliente', // Nombre del Guia
        'direccion', // Dirección del Cliente

        'total', // Total por Consumo
        'motivo', // Motivo de Cancelación
        'comentario', // Comentarios del Servicio
    ];

    protected $primarykey = 'id';
}
