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
        Schema::create('site_visits', function (Blueprint $table) {
            $table->id('site_visit_id');
            $table->foreignId('application_id')->constrained('applications', 'application_id');
            $table->foreignId('officer_id')->constrained('users', 'user_id');
            $table->date('visit_date');

            // Findings & Photos
            $table->text('finding_north')->nullable();
            $table->json('photos_north')->nullable();
            $table->text('findings_south')->nullable();
            $table->json('photos_south')->nullable();
            $table->text('findings_east')->nullable();
            $table->json('photo_east')->nullable();
            $table->text('finding_west')->nullable();
            $table->json('photo_west')->nullable();

            $table->json('attachments')->nullable();

            // Site Conditions
            $table->string('activity')->nullable();
            $table->string('facility')->nullable();
            // Infrastructure
            $table->string('entrance_way')->nullable();
            $table->string('parit')->nullable();
            $table->string('tree')->nullable(); // number of trees maybe?
            $table->text('topography')->nullable();
            //Verify
            $table->string('land_use_zone')->nullable();
            $table->string('density')->nullable();
            $table->boolean('recommend_road')->default(false);
            $table->string('parking')->nullable();
            //other
            $table->string('anjakan')->nullable();
            $table->string('social_facility')->nullable();
            $table->text('location_data')->nullable(); // Extended location remarks
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_visits');
    }
};
