<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Broadcast_Message extends Model
{
    //
    protected $fillable=[
    	'secretary_id',
    	'message'
    ];
    public $timestamps = false;
    public $primaryKey='broadcast_message_id';
}
