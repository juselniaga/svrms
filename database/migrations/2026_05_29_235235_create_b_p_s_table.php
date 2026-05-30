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
        Schema::create('b_p_s', function (Blueprint $table) {
            $table->string('id')->primary(); // Block Perancang ID (Varchar, Unique, Not Null)
            $table->string('bp_short'); // Short code for BP
            $table->string('bp_name'); // Block Perancang name
            $table->boolean('status')->default(true); // Active/Inactive status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_p_s');
    }
};
