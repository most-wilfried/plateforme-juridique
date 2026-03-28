<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $contactIds = Message::where('sender_id', $user->id)
            ->pluck('receiver_id')
            ->merge(Message::where('receiver_id', $user->id)->pluck('sender_id'))
            ->unique()
            ->values();

        $contacts = User::whereIn('id', $contactIds)->get();

        return view('messages.index', compact('contacts'));
    }

    public function show(User $user)
    {
        $auth = Auth::user();

        abort_if($user->id === $auth->id, 403);

        $messages = Message::where(function ($query) use ($auth, $user) {
            $query->where('sender_id', $auth->id)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($query) use ($auth, $user) {
            $query->where('sender_id', $user->id)
                ->where('receiver_id', $auth->id);
        })->orderBy('created_at')
            ->get();

        Message::where('sender_id', $user->id)
            ->where('receiver_id', $auth->id)
            ->update(['is_read' => true]);

        return view('messages.chat', compact('messages', 'user'));
    }

    public function store(Request $request, User $user)
    {
        $auth = Auth::user();

        abort_if($user->id === $auth->id, 403);

        $validated = $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $message = Message::create([
            'sender_id' => $auth->id,
            'receiver_id' => $user->id,
            'content' => $validated['content'],
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'Message envoyé',
            'data' => [
                'id' => $message->id,
                'content' => $message->content,
                'sender_name' => $auth->name,
                'created_at' => $message->created_at->format('d/m/Y H:i'),
            ],
        ], 201);
    }
}
