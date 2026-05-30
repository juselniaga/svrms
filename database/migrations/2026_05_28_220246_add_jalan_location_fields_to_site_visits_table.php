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
        Schema::table('site_visits', function (Blueprint $table) {
            $table->text('finding_jalan')->nullable()->after('photo_west');
            $table->json('photos_jalan')->nullable()->after('finding_jalan');
            $table->text('finding_location')->nullable()->after('photos_jalan');
            $table->json('photos_location')->nullable()->after('finding_location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('site_visits', function (Blueprint $table) {
            $table->dropColumn(['finding_jalan', 'photos_jalan', 'finding_location', 'photos_location']);
        });
    }
};
