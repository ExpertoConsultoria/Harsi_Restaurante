<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public $table = "horario";

      public $fillable = [
        'turno',
        'fecha_ini',
        'fecha_fin'
    ];
    public $primaryKey = "id";
}
