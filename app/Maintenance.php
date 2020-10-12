<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
       protected $fillable=[
    	'rate',
    	'month_year'
    ];
    public $timestamps = false;
    public $primaryKey='maintenance_id';
}
