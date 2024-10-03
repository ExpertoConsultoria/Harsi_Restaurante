<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    protected $table = 'restaurante';

    protected $fillable = [
        'nombre',
        'rfc',
        'direccion',
        'telefono',
        'email',
        'subcategoria',
        'reducir',
        'facebook',
        'instagram',
        'twitter',
        'youTube',
        'linkedIn',
    ];

    protected $primarykey = 'id';

}
