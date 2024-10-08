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
        Schema::create('code_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('code_id')->constrained('code_entries')->onDelete('cascade');
            $table->string('original_filename');
            $table->string('storage_filename');
            $table->string('path', 4096);
            $table->string('media_type');
            $table->mediumInteger('size', false, true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('code_files');
    }
};
