<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor_inforamation extends Model
{
    protected $fillable = [
        'user_id','contact_email','address1', 'address2','city','state','country', 'pincode','area_code','phone_number','website_url', 'facebook_url', 'instagram_url','twitter_url','youtube_url','description', 'about_me'
    ];

    /**
     * Get the vendor.
     *
     * @return User
     */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
