<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_conversation_with_admins', function (Blueprint $table) {
            $table->text('last_message')->nullable();
            $table->timestamp('last_message_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('user_conversation_with_admins', function (Blueprint $table) {
            $table->dropColumn(['last_message', 'last_message_at']);
        });
    }
};
