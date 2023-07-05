<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaProducto extends Model
{
    protected $table = 'categorias';
    protected $fillable =
    [
        'titulo',
    ];

    protected $primarykey = 'id';

    public function producto(){
        return $this->hasMany('App\Models\Producto');
    }
    public function subcategory(){
        return $this->hasMany('App\Models\SubcategoriaProducto');
    }
}
