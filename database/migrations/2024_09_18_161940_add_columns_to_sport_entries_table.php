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
        Schema::table('sport_entries', function (Blueprint $table) {
            // add new columns and change distance from int to decimal
            $table->boolean('status')->after('category_id');
            $table->string('url', 2083)->nullable()->after('distance');
            $table->decimal('distance', total: 3, places: 1)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sport_entries', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('distance');
            $table->unsignedTinyInteger('distance')->nullable();
        });
    }
};
