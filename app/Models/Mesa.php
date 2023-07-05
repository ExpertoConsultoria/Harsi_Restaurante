<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    public $table = "mesas";

    public $fillable =
        [
            'estado',
            'titulo',
            'color'
        ];
    public $primaryKey = "id";

}
