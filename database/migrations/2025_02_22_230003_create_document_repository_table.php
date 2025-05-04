<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('document_repository', function (Blueprint $table) {
            $table->id('document_id');
            $table->string('title');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('teacher_id');
            $table->json('authors');
            $table->json('citations')->nullable();
            $table->json('metadata')->nullable();
            $table->binary('file');
            $table->string('status', 50);
            $table->dateTime('date_submitted');
            $table->dateTime('date_reviewed')->nullable();
            $table->string('study_type', 50);
            $table->dateTime('abandoned_date')->nullable();
            $table->dateTime('recovered_date')->nullable();
            $table->dateTime('lost_date')->nullable();

            $table->foreign('student_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('teacher_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('document_repository');
    }
};

