<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComandaEsp extends Model
{
     protected $table = 'comandaesp';

   protected $fillable =
       [
        'pedido_id',
        'producto',
        'cant',
        'precio_c',
        'sub_total',
       ];

    protected $primarykey = 'id';

     public function pedido(){
        return $this->belongsTo('App\Models\Pedido','pedido_id');
    }
}
