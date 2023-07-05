<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{

    public $table = "calendar";

    public $fillable = [
        'titulo',
        'personas',
        'fecha',
        'mesas',
        'color',
        'detalles',
    ];

    protected $casts = [
        'mesas' => 'array'
    ];
    public $primaryKey = "id";
}
