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
        Schema::create('consultancy_forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');                // Name field
            $table->string('email');               // Email field
            $table->string('organization')->nullable(); // Organization (optional)
            $table->string('phone')->nullable();       // Phone (optional)
            $table->string('help')->nullable();        // How can we help? (optional)
            $table->text('message');               // Message field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultancy_forms');
    }
};
