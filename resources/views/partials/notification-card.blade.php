@if (Session::has('amount'))
    <div class="fixed-top w-25 mt-5" style="margin-left: 41rem">
        <div class="card text-bg-dark" style="width: 18rem;" id="confirmation-card">
            <div class="card-body">
                <h5 class="card-title text-danger fw-bold w-100 text-center fs-3 mb-4">{{ __('CONFIRMATION') }}</h5>
                <h6 class="card-subtitle mb-2 text-light text-center">{{ __('Sorry you are overpaid') }}
                    {{ __('IDR') }}
                    @if (App::isLocale('en'))
                        {{ number_format(session('amount')) }}
                    @else
                        {{ number_format(session('amount'), 0, null, '.') }}
                    @endif
                </h6>
                <p class="card-text text-center">{{ __('Would you like to enter the balance?') }}</p>
                <form action="{{ route('convert', auth()->user()) }}" method="post">
                    @csrf
                    <input type="hidden" name="converted" value="{{ session('amount') }}">
                    <button type="submit" class="btn btn-success w-100 mb-3"
                        id="yesBtn">{{ __('Yes') }}</button>
                    <a href="#fee" class="btn btn-danger w-100" id="noBtn">{{ __('No') }}</a>
                </form>
            </div>
        </div>
    </div>
@elseif (Session::has('amount_underpaid'))
    <div class="fixed-top w-25 mt-5" style="margin-left: 41rem">
        <div class="card text-bg-dark" style="width: 18rem;" id="notif-card">
            <div class="card-body">
                <h5 class="card-title text-danger fw-bold w-100 text-center">{{ __('ERROR') }}</h5>
                <h6 class="card-subtitle mb-2 text-light text-center">{{ __('Sorry you are underpaid') }}
                    {{ __('IDR') }}
                    @if (App::isLocale('en'))
                        {{ number_format(session('amount_underpaid')) }}
                    @else
                        {{ number_format(session('amount_underpaid'), 0, null, '.') }}
                    @endif
                </h6>
            </div>
        </div>
    </div>
@elseif (Session::has('message'))
    <div class="fixed-top w-25 mt-5" style="margin-left: 41rem">
        <div class="card" style="width: 18rem;" id="notif-card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-dark text-center mt-2">{{ __(session('message')) }}
                </h6>
            </div>
        </div>
    </div>
@elseif (Session::has('check'))
    @php
        $avatar = Session::get('check');
        $collections = auth()->user()->collections;
    @endphp
    <div class="w-25">
        <div class="card text-bg-dark"
            style="
            width: 19rem;
            position: fixed;
            left: 50%;
            top: 25%;
            z-index: 1000 !important;
            transform: translateX(-50%);
            "
            id="buySend-card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="#" class="text-light" id="xBtn">
                        <i class="fa-solid fa-x"></i>
                    </a>
                </div>
                <h5 class="card-title text-light fw-bold w-100 text-center fs-3">{{ __('Buy') }} /
                    {{ __('Send') }}</h5>
                <p class="card-text text-center">{{ __('What do you want to do with this avatar?') }}</p>
                @if ($collections->contains('avatar_id', $avatar->id))
                    <p class="card-text text-center text-success fw-bold">({{ __('you already have this avatar') }})
                    </p>
                @endif
                <div class="text-center d-flex align-items-center justify-content-center mb-4">
                    <img src="{{ asset('assets/avatars') }}/{{ $avatar->image }}" style="width: 8rem;">
                </div>
                <form action="{{ route('confirm', $avatar) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100 mb-2" id="buyBtn"
                        @if ($collections->contains('avatar_id', $avatar->id)) disabled @endif>{{ __('Buy') }}</button>
                </form>
                <a href="{{ route('check_send', $avatar) }}" class="btn btn-outline-light w-100 mb-2"
                    id="sendBtn">{{ __('Send') }}</a>
            </div>
        </div>
    </div>
@elseif (Session::has('confirm'))
    @php
        $avatar = Session::get('confirm');
        $auth_user = auth()->user();
    @endphp
    <div class="w-25">
        <div class="card text-bg-dark"
            style="
        width: 19rem;
        position: fixed;
        left: 50%;
        top: 25%;
        z-index: 1000 !important;
        transform: translateX(-50%);
        "
            id="buySend-card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="#" class="text-light" id="xBtn">
                        <i class="fa-solid fa-x"></i>
                    </a>
                </div>
                <h5 class="card-title text-light fw-bold w-100 text-center fs-3">{{ __('Buy') }}</h5>
                <p class="card-text text-center">{{ __('Are you sure you want to buy this avatar for') }}
                    <i class="fa-solid fa-coins"></i>
                    {{ $avatar->price_format }}?
                </p>
                <p class="card-text text-center">({{ __('Your balance is:') }}
                    @if ($auth_user->balance >= $avatar->price)
                        <i class="fa-solid fa-coins text-success"></i>
                        <span class="text-success fw-bold"> {{ $auth_user->balance_format }}</span>
                    @else
                        <i class="fa-solid fa-coins text-danger"></i>
                        <span class="text-danger fw-bold"> {{ $auth_user->balance_format }}</span>
                    @endif
                    )
                </p>
                <div class="text-center d-flex align-items-center justify-content-center mb-4">
                    <img src="{{ asset('assets/avatars') }}/{{ $avatar->image }}" style="width: 8rem;">
                </div>
                <form action="{{ route('buy_avatar', $auth_user) }}" method="post">
                    @csrf
                    <input type="hidden" name="avatar_id" value="{{ $avatar->id }}">
                    <input type="hidden" name="avatar_price" value="{{ $avatar->price }}">
                    <input type="hidden" name="avatar_name" value="{{ $avatar->name }}">
                    <input type="hidden" name="new_balance" value="{{ $auth_user->balance - $avatar->price }}">
                    <button type="submit" class="btn btn-outline-light w-100 mb-2" id="buyBtn"
                        @if ($auth_user->balance < $avatar->price) disabled @endif>{{ __('Yes') }}</button>
                </form>
                <a href="#" class="btn btn-outline-light w-100 mb-2" id="sendBtn">{{ __('No') }}</a>
            </div>
        </div>
    </div>
@elseif(Session::has('checkSend'))
    @php
        $avatar = Session::get('checkSend');
        $auth_user = auth()->user();
    @endphp
    <div class="w-25">
        <div class="card text-bg-dark"
            style="
        width: 30rem;
        position: fixed;
        left: 50%;
        top: 15%;
        z-index: 1000 !important;
        transform: translateX(-50%);
        "
            id="buySend-card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="#" class="text-light" id="xBtn">
                        <i class="fa-solid fa-x"></i>
                    </a>
                </div>
                <form action="{{ route('send_avatar', $auth_user) }}" method="post">
                    @csrf
                    <h5 class="card-title text-light fw-bold w-100 text-center fs-3">{{ __('Send') }}</h5>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <i class="fa-solid fa-coins py-1"></i>
                        <p class="card-text text-center">{{ $avatar->price_format }}</p>
                    </div>
                    @if ($auth_user->balance >= $avatar->price)
                        <p class="card-text text-center">{{ __('Who do you want to send this avatar for?') }}</p>
                        <select class="form-select mb-4" aria-label="Select User" name="sended_user">
                            <option selected disabled>{{ __('Select Users') }}</option>
                            @foreach ($users as $user)
                                @if ($user->collections->contains('avatar_id', $avatar->id))
                                    @continue
                                @endif
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    @else
                        <p class="card-text text-center text-danger fw-bold">{{ __('Insufficient Balance') }}</p>
                    @endif
                    <p class="card-text text-center">({{ __('Your balance is:') }}
                        @if ($auth_user->balance > $avatar->price)
                            <i class="fa-solid fa-coins text-success"></i>
                            <span class="text-success fw-bold"> {{ $auth_user->balance_format }}</span>
                        @else
                            <i class="fa-solid fa-coins text-danger"></i>
                            <span class="text-danger fw-bold"> {{ $auth_user->balance_format }}</span>
                        @endif
                        )
                    </p>
                    <div class="text-center d-flex align-items-center justify-content-center mb-4">
                        <img src="{{ asset('assets/avatars') }}/{{ $avatar->image }}" style="width: 8rem;">
                    </div>
                    <input type="hidden" name="avatar_id" value="{{ $avatar->id }}">
                    <input type="hidden" name="avatar_price" value="{{ $avatar->price }}">
                    <input type="hidden" name="avatar_name" value="{{ $avatar->name }}">
                    <input type="hidden" name="new_balance" value="{{ $auth_user->balance - $avatar->price }}">
                    <button type="submit" class="btn btn-outline-light w-100 mb-2" id="sendBtn"
                        @if ($auth_user->balance < $avatar->price) disabled @endif>{{ __('Send') }}</button>
                </form>
            </div>
        </div>
    </div>
@elseif(Session::has('confirm_hidden'))
    @php
        $auth_user = auth()->user();
    @endphp
    <div class="w-25">
        <div class="card text-bg-dark"
            style="
                width: 19rem;
                position: fixed;
                left: 50%;
                top: 25%;
                z-index: 1000 !important;
                transform: translateX(-50%);
                "
            id="confirm_hidden_card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="#" class="text-light" id="xBtn">
                        <i class="fa-solid fa-x"></i>
                    </a>
                </div>
                <h5 class="card-title text-light fw-bold w-100 text-center fs-3">{{ __('CONFIRMATION') }}</h5>
                <p class="card-text text-center">{{ __('Are you sure you want to be hidden by paying') }}
                    <i class="fa-solid fa-coins"></i>
                    50?
                </p>
                <p class="card-text text-center">({{ __('Your balance is:') }}
                    @if ($auth_user->balance >= 50)
                        <i class="fa-solid fa-coins text-success"></i>
                        <span class="text-success fw-bold"> {{ $auth_user->balance_format }}</span>
                    @else
                        <i class="fa-solid fa-coins text-danger"></i>
                        <span class="text-danger fw-bold"> {{ $auth_user->balance_format }}</span>
                    @endif
                    )
                </p>
                <form action="{{ route('make_hidden', $auth_user) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100 mb-2" id="yesBtn"
                        @if ($auth_user->balance < 50) disabled @endif>{{ __('Yes') }}</button>
                </form>
                <a href="#" class="btn btn-outline-light w-100 mb-2" id="noBtn">{{ __('No') }}</a>
            </div>
        </div>
    </div>
@elseif(Session::has('confirm_visible'))
    @php
        $auth_user = auth()->user();
    @endphp
    <div class="w-25">
        <div class="card text-bg-dark"
            style="
                width: 19rem;
                position: fixed;
                left: 50%;
                top: 25%;
                z-index: 1000 !important;
                transform: translateX(-50%);
                "
            id="confirm_visible_card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="#" class="text-light" id="xBtn">
                        <i class="fa-solid fa-x"></i>
                    </a>
                </div>
                <h5 class="card-title text-light fw-bold w-100 text-center fs-3">{{ __('CONFIRMATION') }}</h5>
                <p class="card-text text-center">{{ __('Are you sure you want to be visible by paying') }}
                    <i class="fa-solid fa-coins"></i>
                    5?
                </p>
                <p class="card-text text-center">({{ __('Your balance is:') }}
                    @if ($auth_user->balance >= 5)
                        <i class="fa-solid fa-coins text-success"></i>
                        <span class="text-success fw-bold"> {{ $auth_user->balance_format }}</span>
                    @else
                        <i class="fa-solid fa-coins text-danger"></i>
                        <span class="text-danger fw-bold"> {{ $auth_user->balance_format }}</span>
                    @endif
                    )
                </p>
                <form action="{{ route('choose_visible', $auth_user) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100 mb-2" id="yesBtn"
                        @if ($auth_user->balance < 5) disabled @endif>{{ __('Yes') }}</button>
                </form>
                <a href="#" class="btn btn-outline-light w-100 mb-2" id="noBtn">{{ __('No') }}</a>
            </div>
        </div>
    </div>
@elseif(Session::has('choose_visible'))
    @php
        $auth_user = auth()->user();
    @endphp
    <div class="w-25">
        <div class="card text-bg-dark"
            style="
                width: 30rem;
                position: fixed;
                left: 50%;
                top: 25%;
                z-index: 1000 !important;
                transform: translateX(-50%);
                "
            id="confirm_visible_card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="#" class="text-light" id="xBtn">
                        <i class="fa-solid fa-x"></i>
                    </a>
                </div>
                <h5 class="card-title text-light fw-bold w-100 text-center fs-3">{{ __('CHOOSE AVATARS') }}</h5>
                <p class="card-text text-center">{{ __('Select which avatar you want to be on your profile') }}
                </p>
                <form
                    action="
                @if (Session::has('chooseSess')) {{ route('change_avatar', $auth_user) }}
                @else
                {{ route('make_visible', $auth_user) }} @endif"
                    method="post">
                    @csrf
                    <div class="d-flex flex-wrap justify-content-center align-items-center overflow-auto"
                        style="max-height: 10rem">
                        @foreach ($auth_user->collections as $collection)
                            <button type="submit" class="btn btn-outline-light mb-3 mx-2" name="profile"
                                value="{{ $collection->avatar->image }}">
                                <img src="{{ asset('assets/avatars') }}/{{ $collection->avatar->image }}"
                                    style="width: 3rem">
                            </button>
                        @endforeach
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
