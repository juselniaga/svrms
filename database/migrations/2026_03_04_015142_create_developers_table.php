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
        Schema::create('developers', function (Blueprint $table) {
            $table->id('developer_id');
            $table->string('name');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('poskod');
            $table->string('city');
            $table->string('state');
            $table->string('email');
            $table->string('fax')->nullable();
            $table->string('tel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('developers');
    }
};
