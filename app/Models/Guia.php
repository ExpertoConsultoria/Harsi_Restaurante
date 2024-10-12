<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    protected $table = 'guias';

    protected $fillable = [
        'full_name',
    ];

    protected $primarykey = 'id';

    //* Relationships
    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'guia_id', 'id');
    }

    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'guia_id', 'id');
    }

    public function comandasTemporales()
    {
        return $this->hasMany(ComandaTemporal::class, 'guia_id', 'id');
    }
}
