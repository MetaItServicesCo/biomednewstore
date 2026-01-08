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
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name');
            $table->string('email');
            $table->text('message');
            // Rating (1 to 5 stars)
            $table->unsignedTinyInteger('rating')
                ->comment('1 = worst, 5 = best');
            // Status / Moderation
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            // Optional meta
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();

            // Audit
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
