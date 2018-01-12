<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Category extends Model
{
    protected $table = "category";

    protected $fillable = ['category_name'];

    public static function storeCategory($input = array()) {
        return Category::create($input);
    }
}
