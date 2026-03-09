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
        Schema::create('sites', function (Blueprint $table) {
            $table->id('site_id');
            $table->foreignId('application_id')->constrained('applications', 'application_id');
            $table->string('mukim');
            $table->string('bpk');
            $table->decimal('luas', 10, 4); // Area in e.g hectares/acres
            $table->decimal('google_lat', 10, 8)->nullable();
            $table->decimal('google_long', 11, 8)->nullable();
            $table->json('map')->nullable(); // Store array of map attachments
            $table->string('lot');
            $table->string('lembaran');
            $table->string('kategori_tanah');
            $table->string('status_tanah');
            $table->string('status')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sites');
    }
};
