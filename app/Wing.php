<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wing extends Model
{
    protected $fillable=[
    	'wing_name',
    	'total_flats'
    ];
    public $timestamps=false;
    protected $primaryKey = 'wing_id';

}
