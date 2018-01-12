<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_comment extends Model
{
    protected $fillable = [
        'name','description','profile_pic'
    ];
}
