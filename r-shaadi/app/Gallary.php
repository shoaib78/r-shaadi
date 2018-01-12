<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{
    protected $table = "gallary";

    protected $fillable = ['user_id','gallary_img','path','status'];

    /**
     * Get the post's gallary.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post's gallary.
     *
     * @return User
     */
    public function user_details()
    {
        //return $this->belongsTo(Vendor_inforamation::class);
        return $this->belongsTo(Vendor_inforamation::class,'user_id');
    }
}
