<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anonymous',100)->nullable();
            $table->decimal('rating', 10, 2);
            $table->text('description')->nullable();
            $table->integer('review_by')->unsigned();
            $table->foreign('review_by')->references('id')->on('users');
            $table->integer('review_for')->unsigned();
            $table->foreign('review_for')->references('id')->on('users');
            $table->tinyInteger('approved')->default('0');
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
        Schema::dropIfExists('reviews');
    }
}
