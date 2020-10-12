<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenitie extends Model
{
    protected $fillable=[
    	'amenitie_name',
    	'amenitie_photo',
    	'open_time',
    	'close_time',
    	'charges'
    ];

    public $timestamps=false;
    protected $primaryKey='amenitie_id';
}
