<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_role', function (Blueprint $table) {
            $table->primary(['profile_id', 'role_id']);
            $table->foreignId('profile_id');
            $table->foreignId('role_id');
            $table->timestamps();

            $table->foreign('profile_id')->references('id')->on('profiles')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
