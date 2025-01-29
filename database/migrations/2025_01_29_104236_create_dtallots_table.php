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
        Schema::create('dtallots', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\Diktei::class);
            $table->foreignIdFor(App\Models\Dtcourse::class);
            $table->boolean('major')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dtallots');
    }
};
