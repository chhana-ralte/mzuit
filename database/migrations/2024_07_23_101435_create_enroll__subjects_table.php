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
        Schema::create('enroll_subject', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Enroll::class);
            $table->foreignIdFor(App\Models\Subject::class);
            $table->integer('internal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enroll__subjects');
    }
};
