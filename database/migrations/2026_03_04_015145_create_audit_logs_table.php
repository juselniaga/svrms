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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications', 'application_id');
            $table->foreignId('user_id')->nullable()->constrained('users', 'user_id');
            $table->string('action'); // e.g transition, update, create
            $table->string('previous_status')->nullable();
            $table->string('new_status')->nullable();
            $table->json('snapshot_old')->nullable(); // Snapshot Differencing
            $table->json('snapshot_new')->nullable(); // Snapshot Differencing
            $table->text('remarks')->nullable();
            $table->timestamp('timestamp')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
