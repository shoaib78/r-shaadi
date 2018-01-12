<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'anonymous','rating','description', 'review_by','review_for','owner'
    ];
}
