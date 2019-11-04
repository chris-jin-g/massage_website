<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Bonus extends Model
{
    use Notifiable;
    Protected $fillable = [
    	'staff_id','bonus','receive_time','note','branch_id',
    ];
}
