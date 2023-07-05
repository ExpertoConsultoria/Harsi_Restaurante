<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComandaTemporal extends Model
{
    protected $table = 'comanda_temporal';

   protected $fillable =
       [
        'fila',
        'fecha',
        'mesa',
        'estado',
        'cajero',
        'cliente',
        'direccion',
        'articulo_id',
        'articulo',
        'cantidad',
        'precio_compra',
        'subtotal',
        'status',
        'motivo',
        'comentario',
       ];

    protected $primarykey = 'id';

    public function producto(){
        return $this->belongsTo('App\Models\Producto','articulo_id');
    }

}
