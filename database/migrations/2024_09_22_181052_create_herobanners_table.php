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
        Schema::create('herobanners', function (Blueprint $table) {
            $table->id();
            $table->string('background_uri');
            $table->string('button_action_uri')->nullable();
            $table->boolean('is_target_blank')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herobanners');
    }
};
