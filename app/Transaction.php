<?php

namespace ttu;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table='transactions';
    protected $fillable=['sender','to_','amount','status','code'];
}
