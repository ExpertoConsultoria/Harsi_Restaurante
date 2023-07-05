<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrecioProducto extends Model
{
    protected $table = 'precioproducto';
    protected $fillable =
    [
      'product_id',
      'precio'
    ];

    protected $primarykey = 'id';

    public function producto(){
       return $this->belongsTo('App\Models\Producto','product_id');
    }

}
