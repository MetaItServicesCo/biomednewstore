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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Category Relation
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->nullOnDelete(); // OR ->onDelete('set null')

            // Product Identity
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->nullable()->unique();

            // Descriptions
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            // Pricing
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('discount_percent')->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();

            // Inventory
            $table->integer('stock_qty')->default(0);
            $table->boolean('in_stock')->default(true);

            // Media
            $table->string('thumbnail')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('image_alt')->nullable();

            // Status
            $table->boolean('is_active')->default(true);

            // SEO
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();

            // Audit Fields
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            // Timestamps
            $table->timestamps();

            // Soft Delete
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
