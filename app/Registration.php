<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    //
    protected $fillable=[
    	'fname',
    	'lname',
    	'email',
    	'password',
    	'phone',
    	'id_proof',
    	'photo',
    	'wing_id',
    	'flat_no',
    	'category',
    	'status',
        'last_login_time'
    ];
    public $timestamps = false;
    public $primaryKey='reg_id';
}
