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
        Schema::create('examtimetables', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Subject::class);
            $table->foreignIdFor(App\Models\Sessn::class);
            $table->date('exam_date');
            $table->integer('shift')->nullable();
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examtimetables');
    }
};
