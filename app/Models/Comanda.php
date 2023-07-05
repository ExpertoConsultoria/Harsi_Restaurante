<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
   protected $table = 'comanda';

    protected $fillable = [
        'pedido_id',
        'articulo_id',
        'articulo',
        'cantidad',
        'precio_compra',
        'subtotal',
    ];

    protected $primarykey = 'id';

    public function orden(){
        return $this->belongsTo('App\Models\Pedido','orden_id');
    }

    public function producto(){
        return $this->belongsTo('App\Models\Producto','articulo_id');
    }
}
