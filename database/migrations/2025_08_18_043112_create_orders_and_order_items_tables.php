<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Create orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('fullname');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->enum('payment_method', ['cod', 'credit', 'bank_transfer']);
            $table->text('notes')->nullable();
            $table->decimal('subtotal', 10, 2);
            $table->decimal('shipping', 10, 2);
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('created_at');
        });

        // Create order_items table
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // Price at time of order
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->index(['order_id', 'product_id']);
        });

        Schema::table('user_cart', function (Blueprint $table) {
            // Add timestamps if they don't exist
            if (!Schema::hasColumn('user_cart', 'created_at')) {
                $table->timestamps();
            }

            // Add indexes for better performance
            if (!Schema::hasIndex('user_cart', 'user_cart_user_id_index')) {
                $table->index('user_id');
            }

            if (!Schema::hasIndex('user_cart', 'user_cart_product_id_index')) {
                $table->index('product_id');
            }
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::table('user_cart', function (Blueprint $table) {
            $table->dropIndex(['user_id']);
            $table->dropIndex(['product_id']);
            $table->dropTimestamps();
        });
    }
};
