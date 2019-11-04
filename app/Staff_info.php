<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff_info extends Authenticatable
{
	use Notifiable;
	// use Encryptable;
    Protected $fillable = [
    	'staff_name', 'staff_id', 'staff_pass','branch_id','role','skill','staff_avatar','team_order',
    ];

   	public function setPasswordAttribute($value)
	{
	    return $this->attributes['staff_pass'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
	}
}
	