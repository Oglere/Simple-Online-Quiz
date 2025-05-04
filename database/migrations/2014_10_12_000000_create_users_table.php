<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('last_name', 100);
            $table->string('first_name', 100);
            $table->string('usn', 100)->unique();
            $table->string('password_hash');
            $table->string('email')->unique();
            $table->string('role', 50);
            $table->dateTime('last_login')->nullable();
            $table->string('status', 8)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
