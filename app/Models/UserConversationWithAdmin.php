<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserConversationWithAdmin extends Model
{
    protected $table = 'user_conversation_with_admins';

    protected $fillable = [
        'user_id',
        'admin_id',
        'last_message',
        'last_message_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        // Admins are actually Users
        return $this->belongsTo(User::class, 'admin_id');
    }
}
