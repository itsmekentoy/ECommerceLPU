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
        Schema::create('item_types', function (Blueprint $table) {
            $table->id();
            $table->string('type_name');
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_type_id')->constrained('item_types')->onDelete('cascade');
            $table->string('item_name');
            $table->text('description')->nullable();
            $table->integer('stock');
            $table->decimal('price', 10, 2);
            $table->text('file_path')->nullable();
            $table->timestamps();

        });

        Schema::create('item_sizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->string('size');
            $table->integer('stock');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_types');
        Schema::dropIfExists('items');
    }
};
