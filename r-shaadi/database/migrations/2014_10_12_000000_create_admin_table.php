<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('username',100)->unique();
            $table->string('email',100)->unique();
            $table->string('password',25);
            $table->string('firstname',100);
            $table->string('lastname',100);
            $table->string('profile_pic')->nullable();
            $table->string('profession',100)->nullable();
            $table->text('about_me')->nullable();
            $table->char('isAdmin', 1)->default('0');
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
        Schema::drop('admin');
    }

}
