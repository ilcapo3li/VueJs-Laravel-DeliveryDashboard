<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use App\Events\MessageSent;
use App\Http\Resources\MessagesCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function fetchMessages()
    {
        $messages = new MessagesCollection(Message::orderBy('created_at', 'desc')->paginate(10));

        return response()->json($messages);
    }

    public function sendMessage(Request $request)
    {
        $sender = Auth::id();
        $message = Message::create([
        'message' => $request->message,
        'user_id' => $sender,
        ]);
        broadcast(new MessageSent(User::find($sender), $message));

        return response()->json('Message Sent Successfully');
    }
}
