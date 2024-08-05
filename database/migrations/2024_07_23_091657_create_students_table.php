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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Person::class);
            $table->foreignIdFor(App\Models\Course::class);
            $table->foreignIdFor(App\Models\Sessn::class);
            $table->string('registration');
            $table->string('rollno');
            $table->string('type');
            $table->boolean('completed');
            $table->boolean('dropout');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
