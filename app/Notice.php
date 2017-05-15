<?php

namespace ttu;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $table="notices";
    protected $fillable=['dp','notice'];
}
