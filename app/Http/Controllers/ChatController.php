<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Participant;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $participants = Participant::with(['room', 'room.chats', 'room.participants', 'user'])
            ->where('user_id', '=', $user->id)->get();

        return view('list-chat', [
            'participants' => $participants,
        ]);
    }

    public function viewChat(User $user, Room $room)
    {
        // get all chats from 2 users
        $chats = Chat::with('user')->where('room_id', '=', $room->id)->get();

        return view('chat', [
            'friend' => $user,
            'room' => $room,
            'chats' => $chats,
        ]);
    }

    public function sendChat(Request $request, User $user, Room $room)
    {
        $request->validate([
            'chat' => 'required'
        ]);

        Chat::create([
            'message' => $request->chat,
            'user_id' => auth()->user()->id,
            'room_id' => $room->id
        ]);

        return redirect()->back();
    }
}
