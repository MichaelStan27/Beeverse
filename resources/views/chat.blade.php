@extends('layout.main')

@section('title', 'Chat')

@section('content')
    <div class="container" style="margin-top: 1.5rem">
        <div class="row">
            <div class="col-xl-12 col-lg-10 col-md-10 col-sm-12 col-12 mx-auto">
                <div class="card shadow-sm" style="background: #2d2e30">
                    <div class="card-header"
                        style="background: #2d2e30;border: 0;
                    font-size: 1.5rem;
                    padding: .65rem 1rem;
                    position: relative;
                    font-weight: 600;
                    color: #ffffff;">
                        <img src="{{ asset('assets/avatars') }}/{{ $friend->photo_profile }}" alt=""
                            style="width: 48px; margin-right: 1rem">
                        {{ $friend->name }}
                    </div>
                    <div class="card-body height3 overflow-auto d-flex flex-column-reverse"
                        style="background: #2d2e30; height: 28rem">
                        <ul class="chat-list" id="chat-list" style="padding: 0;
                        font-size: 0.9rem;">
                            @foreach ($chats as $chat)
                                <li class="@if ($chat->user_id == auth()->user()->id) out @else in @endif">
                                    <div class="chat-body">
                                        <div class="chat-message">
                                            <p>{{ $chat->message }}</p>
                                            @if (now()->format('Y-m-d') > $chat->date_compare)
                                                <small class="time">{{ $chat->date_created }}</small>
                                            @endif
                                            <small class="time">{{ $chat->time_created }}</small>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <form action="{{ route('chat', ['user' => $friend, 'room' => $room]) }}" method="post">
                        @csrf
                        <div class="d-flex justify-content-center align-content-center gap-2 mt-2">
                            <input type="text" name="chat" id="chat" class="rounded-5 w-75 px-3"
                                autocomplete="off" placeholder="Write a message...">
                            <button type="submit" class="border-0" style="background: #2d2e30"><i
                                    class="fa-solid fa-paper-plane fa-lg text-light"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    .chat-list .out {
        margin-bottom: 10px;
        overflow: auto;
        color: #000000;
    }

    .chat-list li {
        margin-bottom: 10px;
        overflow: auto;
        color: #ffffff;
    }

    .chat-list .chat-message {
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        background: #555555;
        display: inline-block;
        padding: 10px 20px;
        position: relative;
    }

    .chat-list .chat-message:before {
        content: "";
        position: absolute;
        top: 15px;
        width: 0;
        height: 0;
    }

    .chat-list .chat-message p {
        line-height: 20px;
        margin: 0;
        padding: 0;
        text-align: justify;
    }

    .chat-list .chat-body {
        margin-left: 20px;
        float: left;
        width: 70%;
    }

    .chat-list .chat-body .time {
        color: gray;
        width: fit-content;
        font-size: .7rem;
        font-weight: bold;
    }

    .chat-list .in .chat-message:before {
        left: -12px;
        border-bottom: 20px solid transparent;
        border-right: 20px solid #555555;
    }

    .chat-list .out .chat-body {
        float: right;
        margin-right: 20px;
        text-align: right;
    }

    .chat-list .out .chat-message {
        background: #86d97b;
    }

    .chat-list .out .chat-message:before {
        right: -12px;
        border-bottom: 20px solid transparent;
        border-left: 20px solid #86d97b;
    }

    .card .card-header:first-child {
        -webkit-border-radius: 0.3rem 0.3rem 0 0;
        -moz-border-radius: 0.3rem 0.3rem 0 0;
        border-radius: 0.3rem 0.3rem 0 0;
    }
</style>
