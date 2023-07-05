<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubcategoriaProducto extends Model
{
    protected $table = 'subcategorias';
    protected $fillable =
    [
        'titulo','category_id'
    ];

    protected $primarykey = 'id';

    public function categoriaProducto(){
        return $this->belongsTo('App\Models\CategoriaProducto','category_id');
    }
}
