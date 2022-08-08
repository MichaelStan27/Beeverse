<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('hobby_id')->constrained();
            $table->foreignId('avatar_id')->constrained();
            $table->string('name');
            $table->string('photo_profile');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('number');
            $table->string('address');
            $table->integer('balance');
            $table->boolean('hidden');
            $table->string('password');
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
