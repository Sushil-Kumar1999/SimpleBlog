<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->longText('body');
            $table->timestamps();

            $table->foreignId('profile_id');
            $table->foreign('profile_id')->references('id')->on('profiles')
                ->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreignId('post_id');
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
