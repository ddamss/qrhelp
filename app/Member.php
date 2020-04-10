<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $fillable=['first_name','last_name','address','mobile_number','image'];

}
