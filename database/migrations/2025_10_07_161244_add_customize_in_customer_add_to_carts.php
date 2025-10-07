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
        Schema::table('customer_addto_carts', function (Blueprint $table) {
            $table->integer('customization')->default(0)->after('item_id');
            $table->decimal('price', 10, 2)->default(0)->after('customization');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_addto_carts', function (Blueprint $table) {
            $table->dropColumn('customization');
            $table->dropColumn('price');
        });
    }
};
