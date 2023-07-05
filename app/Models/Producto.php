<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

     protected $fillable = [
        'category_id',
        'subcategory_id',
        'titulo',
        'precio'
    ];

    protected $primarykey = 'id';

     public function categoriaProducto(){
        return $this->belongsTo('App\Models\CategoriaProducto','category_id');
    }
    public function subcategoriaProducto(){
        return $this->belongsTo('App\Models\SubcategoriaProducto','subcategory_id');
    }
}
