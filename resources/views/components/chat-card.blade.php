@props(['friend', 'room'])

@php
$friendParticipants = $friend->participants->where('room_id', '=', $room->id)->first();
@endphp

<a href="" class="text-dark hover" style="text-decoration: none">
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
                    @if ($friendParticipants->chats)
                    @else
                        {{ $room->date_created }}
                    @endif
                </h5>
            </div>
            <h5 class="fw-bolder text-secondary fs-6" style="margin-top: -1rem">
                @if ($friendParticipants->chats)
                @else
                    {{ $room->time_created }}
                @endif
            </h5>
            <p class="mt-5">
                @if ($friendParticipants->chats)
                @else
                    <h4 class="fs-5 fw-bold">
                        Start chatting with your friend!
                    </h4>
                @endif
            </p>
        </div>
    </div>
</a>
