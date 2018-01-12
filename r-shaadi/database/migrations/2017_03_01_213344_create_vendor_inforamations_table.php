<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorInforamationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_inforamations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('address1',100)->nullable();
            $table->string('address2',100)->nullable();
            $table->string('city',25)->nullable();
            $table->string('state',25)->nullable();
            $table->string('country',25)->nullable();
            $table->string('pincode',25)->nullable();
            $table->string('area_code',25)->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->string('website_url',100)->nullable();
            $table->string('facebook_url',100)->nullable();
            $table->string('instagram_url',100)->nullable();
            $table->string('twitter_url',100)->nullable();
            $table->string('youtube_url',100)->nullable();
            $table->text('about_me')->nullable();
            $table->integer('category')->nullable();
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
        Schema::dropIfExists('vendor_inforamations');
    }
}
