@extends('layout.main')

@section('title', 'List Chats')

@section('content')
    <div class="justify-content-center mx-auto" style="padding: 3rem">
        @forelse ($chats as $chat)
            @php
                $friend = $chat->room->participants->where('user_id', '<>', auth()->user()->id)->first()->user;
            @endphp
            <x-chat-card :friend="$friend" :room="$chat->room"></x-chat-card>
        @empty
        @endforelse
    </div>
@endsection
