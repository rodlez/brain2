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
        Schema::create('sport_entries', function (Blueprint $table) {
            $table->id();
            // create the user_id column that be the foreign key id in the users DB Table
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // create the category_id column that be the foreign key id in the categories DB Table
            $table->foreignId('category_id')->constrained('sport_categories');
            $table->string('title');
            $table->date('date');
            $table->string('location');
            $table->unsignedSmallInteger('duration');
            $table->unsignedTinyInteger('distance')->nullable();
            $table->text('info')->nullable();
            $table->timestamps();
        });

        Schema::table('sport_entries', function (Blueprint $table) {
            $table->index('user_id');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sport_entries');
    }
};
