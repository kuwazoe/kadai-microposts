<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMicropostFavoriteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('micropost_favorite', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('micropost_id')->unsigned()->index();
            $table->integer('favorite_id')->unsigned()->index();
            $table->timestamps();
            
            $table->foreign('micropost_id')->references('id')->on('microposts');
            $table->foreign('favorite_id')->references('id')->on('users');
            
            $table->unique(['micropost_id', 'favorite_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('micropost_favorite');
    }
}
