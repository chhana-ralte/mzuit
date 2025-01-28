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
        Schema::create('dtcourses', function (Blueprint $table) {
            $table->id();
            $table->string('dept');
            $table->string('code');
            $table->string('title');
            $table->boolean('major');
            $table->integer('credit');
            $table->integer('intake');
            $table->string('faculty');
            $table->string('contact');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_tcourses');
    }
};
