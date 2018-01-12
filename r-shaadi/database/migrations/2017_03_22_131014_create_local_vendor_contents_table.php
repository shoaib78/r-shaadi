<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalVendorContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_vendor_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100)->nullable();
            $table->text('description')->nullable();
            $table->string('image',100)->nullable();
            $table->string('link',100)->nullable();
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
        Schema::dropIfExists('local_vendor_contents');
    }
}
