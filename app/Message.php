<?php

namespace ttu;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table="messages";
    protected $fillable=['dp','minidp'
        ,'from_','to_','message','status'];
    
}
