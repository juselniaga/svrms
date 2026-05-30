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
        Schema::create('mukims', function (Blueprint $table) {
            $table->id();
            $table->string('mukim_no')->unique(); // Mukim number
            $table->string('short_mukim'); // Short code for mukim
            $table->string('mukim'); // Mukim name
            $table->boolean('status')->default(true); // Active/Inactive status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mukims');
    }
};
