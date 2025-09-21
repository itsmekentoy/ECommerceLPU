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
        Schema::table('customer_information', function (Blueprint $table) {
            $table->enum('status', ['active', 'banned', 'suspended'])->default('active')->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_information', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
