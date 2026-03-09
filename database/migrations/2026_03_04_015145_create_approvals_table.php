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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id('approval_id');
            $table->foreignId('application_id')->constrained('applications', 'application_id');
            $table->foreignId('director_id')->constrained('users', 'user_id');
            $table->string('decision'); // Approved, Rejected, etc
            $table->text('conditions')->nullable();
            $table->text('remarks')->nullable(); // For rejection reason etc
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approvals');
    }
};
