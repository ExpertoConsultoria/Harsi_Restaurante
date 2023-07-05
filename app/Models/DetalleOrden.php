<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    protected $table = 'comanda';
    protected $fillable = [
        'orden_id',
        'articulo',
        'cantidad',
        'precio_compra',
        'subtotal',
        'pespecial',
        'pesprecio',
        'pespcant',
        'subtotales'

    ];

    protected $primarykey = 'id';


   public function producto(){
       return $this->belongsTo('App\Models\Producto','articulo_id');
    }
    public function pedido(){
        return $this->belongsTo('App\Models\Pedido','orden_id');
    }
}
