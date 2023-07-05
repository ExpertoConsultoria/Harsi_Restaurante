<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenCancelado extends Model
{
     protected $table = 'orden_cancelado';
    protected $fillable =
       [
        'fecha',
        'mesa',
        'cajero',
        'cliente',
        'direccion',
        'total',
        'motivo',
        'comentario',
       ];
    protected $primarykey = 'id';

}
