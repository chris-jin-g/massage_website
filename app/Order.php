<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
	use Notifiable;
    Protected $fillable = [
    	'client_name', 'staff_id', 'ordered_service','room_id','start_time', 'last_time', 'duration', 'pay_status', 'current_state','estimate_cost','branch_id','cost',
    ];
}
