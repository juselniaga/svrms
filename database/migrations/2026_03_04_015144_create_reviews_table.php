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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('review_id');
            $table->foreignId('application_id')->constrained('applications', 'application_id');
            $table->foreignId('officer_id')->constrained('users', 'user_id');
            $table->text('review_content');
            $table->string('recommendation'); // E.g., Approve, Reject, Approve with Conditions
            $table->boolean('self_check_completed')->default(false);
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
