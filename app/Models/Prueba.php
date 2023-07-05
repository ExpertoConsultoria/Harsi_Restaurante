<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prueba extends Model
{
   protected $connection = 'mysql_second';
   protected $table = 'tables';
   public $fillable = ['id','table_name'];
}
