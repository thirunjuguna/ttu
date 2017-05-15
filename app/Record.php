<?php

namespace ttu;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table="records";
    protected $fillable=['user_id','year','status'];
}
   