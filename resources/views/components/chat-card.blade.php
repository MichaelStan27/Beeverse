@props(['friend', 'room', 'chats'])

<a href="{{ route('chat', ['user' => $friend, 'room' => $room]) }}" class="text-dark hover" style="text-decoration: none">
    <div class="d-flex w-100 border rounded-2 shadow-sm mx-auto mb-3 row">
        <div class="col-sm-2 py-3" style="padding-left: 3rem">
            <img src="{{ asset('assets/avatars') }}/{{ $friend->photo_profile }}" style="width: 10rem">
        </div>
        <div class="col-sm-10">
            <div class="d-flex justify-content-between align-content-center">
                <h3 class="py-3 fw-bold">
                    {{ $friend->name }}
                </h3>
                <h5 class="fw-bolder text-secondary fs-6 mt-3">
                    @if ($chats->isEmpty())
                        {{ $room->date_created }}
                    @else
                        {{ $chats->last()->date_created }}
                    @endif
                </h5>
            </div>
            <h5 class="fw-bolder text-secondary fs-6" style="margin-top: -1rem">
                @if ($chats->isEmpty())
                    {{ $room->time_created }}
                @else
                    {{ $chats->last()->time_created }}
                @endif
            </h5>
            <p class="mt-5">
                @if ($chats->isEmpty())
                    <h4 class="fs-5 fw-bold">
                        {{ __('Start chatting with your friend!') }}
                    </h4>
                @else
                    <p class="fs-5 text-secondary">
                        {{ Str::limit($chats->last()->message, 300, $end = '...') }}
                    </p>
                @endif
            </p>
        </div>
    </div>
</a>
