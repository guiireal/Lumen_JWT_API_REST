<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {

    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user', 40);
            $table->string('email', 100);
            $table->string('password', 255);
            $table->boolean('verified');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }

}
