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
        Schema::create('b_p_k_s', function (Blueprint $table) {
            $table->string('id')->primary(); // Block Perancang Kecil ID (Varchar, Unique, Not Null)
            $table->string('bp_id'); // Foreign Key from BPs table
            $table->string('bpk_short'); // Short code for BPK
            $table->string('bpk_name'); // Block Perancang Kecil name
            $table->boolean('status')->default(true); // Active/Inactive status
            $table->timestamps();

            // Add foreign key constraint
            $table->foreign('bp_id')->references('id')->on('b_p_s')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_p_k_s');
    }
};
