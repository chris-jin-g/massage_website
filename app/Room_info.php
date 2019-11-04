<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Room_info extends Model
{
    use Notifiable;
    Protected $fillable = [
    	'room_id', 'room_img', 'branch_id', 'used','team_order',
    ];
}
