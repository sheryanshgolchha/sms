<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_Provider extends Model
{
    	protected $fillable=[
    	'service_id',
    	'name',
    	'phone',
    	'photo',
    	'address',
    	'id_proof'
    ];

    public $timestamps=false;
    protected $primaryKey = 'service_provider_id';
}
