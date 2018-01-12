<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesDetailInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_detail_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('vendor_category')->nullable();
            $table->string('vanue_type',25)->nullable();
            $table->string('vanue_settings',255)->nullable();
            $table->decimal('vanue_min_price', 50, 2)->nullable();
            $table->decimal('vanue_max_price', 50, 2)->nullable();
            $table->tinyInteger('bridal_makeup_offer')->default('0');
            $table->decimal('bridal_makeup_starting_price', 50, 2)->nullable();
            $table->tinyInteger('photographer_vidoegraphy_service_provide')->default('0');
            $table->tinyInteger('photographer_photo_booth_service_provide')->default('0');
            $table->decimal('photographer_starting_price', 50, 2)->nullable();
            $table->tinyInteger('videographer_photography_service_provide')->default('0');
            $table->decimal('videographer_starting_price', 50, 2)->nullable();
            $table->string('wedding_dj_music_offer',255)->nullable();
            $table->string('transportation_vechile_available',255)->nullable();
            $table->string('wedding_entertainment_sub_category',25)->nullable();
            $table->string('officiant_religion',25)->nullable();
            $table->string('additional_service',25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_detail_infos');
    }
}
