<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
   protected $connection = 'mysql_second';
   protected $table = 'rooms';
   public $fillable = [
   'room_number',
   'roomType_id',
   'room_status',
   'room_floor',
   'room_price',
   'room_group_id'];
}
