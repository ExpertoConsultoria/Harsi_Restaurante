<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DescuentoUsuario extends Model
{
    public $table = "descuento_usuario";

    public $fillable = [
        'role',
        'descuento'
    ];
    public $primaryKey = "id";
}
