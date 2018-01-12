<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->string('username',100)->unique();
            $table->string('email',100)->unique();
            $table->string('password');
            $table->char('usertype', 1)->default('1');
            $table->string('profile_pic',100)->nullable();
            $table->string('banner',100)->nullable();
            $table->string('company_name',100)->nullable();
            $table->string('gender',25)->nullable();
            $table->dateTime('birthdate')->nullable();
            $table->integer('category')->nullable();
            $table->string('street',100)->nullable();
            $table->string('city',25)->nullable();
            $table->string('state',25)->nullable();
            $table->string('country',25)->nullable();
            $table->string('pincode',25)->nullable();
            $table->integer('area_code')->nullable();
            $table->bigInteger('phone_number')->nullable();
            $table->bigInteger('mobile_num')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
