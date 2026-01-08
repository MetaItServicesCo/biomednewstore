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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Full Name
            $table->string('email'); // Email Address
            $table->string('phone')->nullable(); // Phone Number
            $table->string('company')->nullable(); // Company / Hospital Name
            $table->string('service')->nullable(); // Selected Service
            $table->json('categories')->nullable(); // Equipment Categories (array of slugs)
            $table->text('message')->nullable(); // Message / Details
            $table->string('preferred_contact')->nullable(); // Preferred contact
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
