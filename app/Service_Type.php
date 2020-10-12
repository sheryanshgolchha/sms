<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_Type extends Model
{
	protected $fillable=[
    	'service_type'
    ];

    public $timestamps=false;
    protected $primaryKey = 'service_id';
}
