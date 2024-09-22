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
        Schema::create('herobanner_locales', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->default('en');
            $table->foreignId('herobanner_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('text');
            $table->string('button_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('herobanner_locales');
    }
};
