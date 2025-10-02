<?php

namespace App\Http\Controllers;

use App\Models\UserConversationWithAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserConversationWithAdminController extends Controller
{
    // Get or create a conversation between admin and customer
    public function getOrCreate(Request $request)
    {
        $userId = $request->input('user_id');
        $adminId = Auth::guard('admin')->user()->id; // Or pass admin_id from frontend if needed

        $conversation = UserConversationWithAdmin::where('user_id', $userId)
            ->where('admin_id', $adminId)
            ->first();

        if (! $conversation) {
            $conversation = UserConversationWithAdmin::create([
                'user_id' => $userId,
                'admin_id' => $adminId,
                'last_message' => null,
                'last_message_at' => null,
            ]);
        }

        return response()->json(['conversation_id' => $conversation->id]);
    }
}
