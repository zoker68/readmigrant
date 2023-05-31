<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->string('country_id');
            $table->string('city');
            $table->string('author');

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_main')->nullable();
            $table->string('conditions')->nullable();
            $table->boolean('is_published')->nullable();
            $table->boolean('mailed')->nullable();
            $table->boolean('send_border')->nullable();


            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
