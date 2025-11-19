<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConversationMessage;

class ConversationMessageController extends Controller
{
    // Fetch messages for a conversation
    public function fetch(Request $request)
    {
        $conversationId = $request->input('conversation_id');
        $receiverType = $request->input('receiver_type');
        $receiverId = $request->input('receiver_id');
        // Mark unread messages as read only for messages not sent by the receiver
        ConversationMessage::where('conversation_id', $conversationId)
            ->where('is_read', false)
            ->where(function($query) use ($receiverType, $receiverId) {
                $query->where('sender_type', '!=', $receiverType)
                      ->orWhere('sender_id', '!=', $receiverId);
            })
            ->update(['is_read' => true]);
        $messages = ConversationMessage::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json($messages);
    }

    // Send a new message
    public function send(Request $request)
    {
        $message = ConversationMessage::create([
            'conversation_id' => $request->input('conversation_id'),
            'sender_type' => $request->input('sender_type'),
            'sender_id' => $request->input('sender_id'),
            'message' => $request->input('message'),
            'is_read' => false,
        ]);
        return response()->json($message);
    }
}
