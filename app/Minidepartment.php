<?php

namespace ttu;

use Illuminate\Database\Eloquent\Model;

class Minidepartment extends Model
{
    protected $table="minidepartments";
    protected $fillable=['dp_id','department'];
}