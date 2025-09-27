<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConversationMessage extends Model
{
    protected $table = 'conversation_messages';

    protected $fillable = [
        'conversation_id',
        'sender_type',
        'sender_id',
        'message',
        'is_read',
    ];

    public function conversation()
    {
        return $this->belongsTo(UserConversationWithAdmin::class, 'conversation_id');
    }
}
