<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $participants = Participant::with(['room', 'room.participants', 'user'])->where('user_id', '=', $user->id)->get();

        return view('list-chat', [
            'chats' => $participants,
        ]);
    }
}
