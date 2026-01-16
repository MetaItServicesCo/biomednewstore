<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            
            // Email & Personal Info
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company')->nullable();
            
            // Address Info
            $table->string('street_address');
            $table->string('street_address_2')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();;
            $table->unsignedBigInteger('state_id')->nullable();;
            $table->unsignedBigInteger('city_id')->nullable();;
            $table->string('postal_code')->nullable();;
            $table->string('phone_number');
            
            // Order Info
            $table->decimal('subtotal', 10, 2)->default(0.00);
            $table->decimal('shipping', 10, 2)->default(0.00);
            $table->decimal('tax', 10, 2)->default(0.00);
            $table->decimal('gst', 10, 2)->default(0.00);
            $table->decimal('total', 10, 2)->default(0.00);

            
            // Shipping Method
            $table->enum('shipping_method', ['standard', 'pickup'])->default('standard');
            
            // Payment Info
            $table->enum('payment_status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('stripe_payment_intent_id')->nullable();
            $table->text('payment_error_message')->nullable();
            
            // Order Status
            $table->enum('order_status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            
            // Timestamps
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
            
            // Foreign Keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('restrict');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
