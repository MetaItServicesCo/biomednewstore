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
        Schema::table('products', function (Blueprint $table) {
            $table->string('condition')->nullable();
            $table->string('availability')->nullable();
            // Rating (1 to 5 stars)
            $table->unsignedTinyInteger('rating')
                ->comment('1 = worst, 5 = best');

            $table->string('brochures')->nullable();

            $table->string('model')->nullable();

            $table->string('product_type')->nullable()
                  ->comment('product | part');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'condition',
                'availability',
                'rating',
                'brochures',
                'model',
                'product_type',
            ]);
        });
    }
};
