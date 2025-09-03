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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->string('order_code');
            $table->unsignedBigInteger('customer_id');
            $table->integer('status')->default(0); // 0: Added to Cart 1: Pending 2: Accepted 3: Completed 4: Cancelled 5: Rejected
            $table->timestamps();
        });

        Schema::create('order_detail_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_detail_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
        Schema::create('order_detail_item_customizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_detail_id');
            $table->unsignedBigInteger('item_id');
            $table->string('textile');
            $table->string('size');
            $table->string('type');
            $table->timestamps();
        });
           
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('order_detail_items');
        Schema::dropIfExists('order_detail_item_customizations');
    }
};
