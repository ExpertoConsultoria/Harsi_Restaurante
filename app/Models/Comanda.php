<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    protected $table = 'comanda';

    protected $fillable = [
        'pedido_id', // Id de la Orden
        'articulo', // Nombre del Producto
        'cantidad', // Cantidad del Producto Solicitado
        'precio_compra', // Precio del Producto
        'subtotal', // Total a pagar por los Productos

        'ready_to_serve', // Estado de Preparación del Platillo
        'preparation_specifications', // Especificaciones del Platillo
    ];

    protected $primarykey = 'id';

    public function orden()
    {
        return $this->belongsTo('App\Models\Pedido', 'orden_id');
    }

    public function producto()
    {
        return $this->belongsTo('App\Models\Producto', 'articulo_id');
    }
}
