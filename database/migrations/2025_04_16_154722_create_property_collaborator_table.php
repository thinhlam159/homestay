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
        Schema::create('property_collaborator', function (Blueprint $table) {
            $table->foreignUlid('property_id')->constrained('properties');
            $table->foreignUlid('user_id')->constrained('users');
            $table->primary(['property_id', 'user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_collaborator');
    }
};
