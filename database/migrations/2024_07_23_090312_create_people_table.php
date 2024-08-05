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
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->string('father')->nullable();
            $table->string('mother')->nullable();
            $table->date('dob')->nullable();
            $table->string('aadhar')->nullable();
            $table->string('PAN')->nullable();
            $table->string('voter')->nullable();
            $table->string('category')->nullable();
            $table->string('religion')->nullable();
            $table->string('gender')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
