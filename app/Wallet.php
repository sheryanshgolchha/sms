<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable=[
    	'reg_id',
    	'amount'
    ];

    public $timestamps=false;
    protected $primaryKey = 'wallet_id';
}
