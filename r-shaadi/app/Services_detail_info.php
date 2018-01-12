<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services_detail_info extends Model
{
    protected $fillable = [
        'user_id','vanue_type', 'vanue_settings','vanue_min_price','vanue_max_price','bridal_makeup_offer', 'bridal_makeup_starting_price','photographer_vidoegraphy_service_provide','photographer_photo_booth_service_provide','photographer_starting_price', 'videographer_photography_service_provide', 'videographer_starting_price','wedding_dj_music_offer','transportation_vechile_available','wedding_entertainment_sub_category', 'officiant_religion', 'additional_service','vendor_category'
    ];
}
