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
        Schema::create('sport_entry_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sport_entry_id')->constrained('sport_entries')->onDelete('cascade');
            $table->foreignId('sport_tag_id')->constrained('sport_tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_entry_tag');
    }
};
