<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local_vendor_content extends Model
{
    protected $fillable = [
        'title','description','image','link'
    ];
}
