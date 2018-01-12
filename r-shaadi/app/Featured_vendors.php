<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Featured_vendors extends Model
{
    protected $fillable = [
        'category','company_name','featured_image','vendor_profile_link',
    ];
}
