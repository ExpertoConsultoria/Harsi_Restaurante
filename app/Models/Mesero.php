<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mesero extends Model
{
    protected $table = 'meseros';

    protected $fillable = [
        'full_name',
    ];

    protected $primarykey = 'id';

    //* Relationships
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'mesero_id', 'id');
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'mesero_id', 'id');
    }

    public function comandasTemporales()
    {
        return $this->hasMany(ComandaTemporal::class, 'mesero_id', 'id');
    }
}

