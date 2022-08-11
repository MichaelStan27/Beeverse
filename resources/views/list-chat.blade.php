@extends('layout.main')

@section('title', 'List Chats')

@section('content')
    <div class="justify-content-center mx-auto" style="padding: 3rem">
        @forelse ($participants as $participant)
            @php
                $friend = $participant->room->participants->where('user_id', '<>', auth()->user()->id)->first()->user;
            @endphp
            <x-chat-card :friend="$friend" :room="$participant->room" :chats="$participant->room->chats"></x-chat-card>
        @empty
            <h3 class="fw-bold text-secondary text-center">YOU ARE CURRENTLY HAVE NO FRIEND :/</h3>
        @endforelse
    </div>
@endsection
