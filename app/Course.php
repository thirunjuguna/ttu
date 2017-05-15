<?php

namespace ttu;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table="courses";
    protected $fillable=['mini_dp_id','course'];
}
