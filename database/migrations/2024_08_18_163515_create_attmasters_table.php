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
        Schema::create('attmasters', function (Blueprint $table) {
            $table->id();
            $table->date('dt');
            $table->foreignIdFor(App\Models\Sessn::class);
            $table->foreignIdFor(App\Models\Subject::class);
            $table->foreignIdFor(App\Models\User::class);
            $table->integer('slots')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attmasters');
    }
};
