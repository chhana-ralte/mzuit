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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Syllabus::class);
            $table->string('code');
            $table->string('name');
            $table->integer('semester');
            $table->integer('type');
            $table->integer('L');
            $table->integer('T');
            $table->integer('P');
            $table->integer('credit');
            $table->integer('full_mark');
            $table->integer('internal');
            $table->integer('external');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
