<?php

namespace ttu;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{
    protected $table='remarks';
    protected $fillable=['record','remark','price','dp','minidp','status','reg','year'];
}
