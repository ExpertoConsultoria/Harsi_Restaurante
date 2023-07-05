<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComandaCancelado extends Model
{
    protected $table = 'comanda_cancelado';

   protected $fillable =
       [
        'orden_id',
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
