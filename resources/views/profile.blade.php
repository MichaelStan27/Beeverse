@php
$number = 1;
@endphp

@extends('layout.main')

@section('title', 'Profile')

@section('content')
    <div class="flex justify-content-center mx-auto" style="padding: 3rem">
        <h1 class="text-center pb-3 fw-bold" style="color: gray">PROFILE</h1>
        <div class="text-center">
            @auth
                @if ($user->id == auth()->user()->id)
                    {{-- PROFILE SECTION --}}
                    <div class="row gap-3">
                        <div class="col-sm-8 border shadow-sm rounded-3 text-center">
                            <div class="d-flex align-items-center justify-content-evenly">
                                <div class="">
                                    <img src="{{ asset('assets/avatars') }}/{{ $user->photo_profile }}" class="card-img-top mt-3"
                                        style="width: 12rem">
                                    <h2 class="fw-bold mt-2">{{ $user->name }}</h2>
                                    <h3 class="fs-4 fw-bold" style="color: gray">{{ $user->gender }}</h3>
                                </div>
                                <div class="">
                                    <h2 class="fw-bold mb-4">DETAILS</h2>
                                    <table class="table text-left">
                                        <tbody>
                                            <tr>
                                                <th scope="row"><i class="fa-solid fa-envelope fa-xl pb-2"></i></th>
                                                <td>
                                                    <h5 class="text-left">{{ $user->email }}</h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><i class="fa-solid fa-mobile fa-xl pb-2"></i></th>
                                                <td>
                                                    <h5 class="text-left">{{ $user->number }}</h5>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row"><i class="fa-solid fa-location-dot fa-xl pb2"></i></i></th>
                                                <td>
                                                    <h5 class="text-left">{{ $user->address }}</h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    @if (!$user->collections->isEmpty() && !$user->hidden)
                                        <form action="{{ route('choose_avatar', $user) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary w-100">Edit Profile</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3 mb-3">
                                <h3 class="fw-bold text-secondary">HOBBIES</h3>
                                <div class="row d-flex justify-content-center gap-1">
                                    @foreach ($user->headerHobbies as $header)
                                        <div class="col border rounded-2 mx-3 bg-secondary text-light shadow-sm py-2">
                                            <img src="{{ asset('assets/hobbies') }}/{{ $header->hobby->image }}" alt=""
                                                style="width: 5rem">
                                            <span class="fw-bold fs-5" style="margin-left: 1rem">
                                                {{ $header->hobby->activity }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        {{-- SETTING CARD SECTION --}}
                        <div class="col-sm-3 border shadow-sm rounded-3 px-0" style="max-height: 18.5rem">
                            <div class="border-bottom fw-bold">
                                <a href="#" class="btn w-100 py-4 fw-bold" id="collectionBtn">
                                    COLLECTIONS
                                </a>
                            </div>
                            <div class="border-bottom fw-bold">
                                <a href="#" class="btn w-100 py-4 fw-bold" id="topupBtn"
                                    @if (Session::has('topupSess')) style="background-color: black; color: white;" @endif>
                                    TOP UP
                                </a>
                            </div>
                            <div class="border-bottom fw-bold">
                                <a href="#" class="btn w-100 py-4 fw-bold" id="settingBtn"
                                    @if (Session::has('visibleSess')) style="background-color: black; color: white;" @endif>
                                    SETTINGS
                                </a>
                            </div>
                            <div class="border-bottom fw-bold">
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn w-100 py-4 fw-bold">LOGOUT</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- COLLECTIONS CARD SECTION --}}
                        <div class="col-sm-8 border shadow-sm rounded-3 text-center mt-3 py-4 px-4 bg-dark" id="collections"
                            style="display: none">
                            <h3 class="fw-bold mt-2 text-light mb-3">COLLECTIONS</h3>
                            @if (!$user->collections->isEmpty())
                                <div class="overflow-auto" style="max-height: 35rem">
                                    <div class="row row-cols-1 row-cols-md-4">
                                        @foreach ($user->collections as $collection)
                                            <div class="col">
                                                <x-collection-card :collection="$collection"></x-collection-card>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <h3 class="text-light">{{ $user->name }}'s collection is empty</h3>
                                    <i class="fa-solid fa-face-sad-tear text-light fa-xl pb-1"></i>
                                </div>
                            @endif
                            @if (!$user->transactions->isEmpty() || !$user->receives->isEmpty())
                                {{-- TRANSACTIONS SECTION --}}
                                <h3 class="fw-bold mt-4 text-light mb-3">TRANSACTIONS</h3>
                                <div class="overflow-auto" style="max-height: 15rem">
                                    <table class="table table-dark table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Avatar</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->transactions as $transaction)
                                                <tr>
                                                    <th scope="row">{{ $number++ }}</th>
                                                    <td>{{ $transaction->user_sent->name }}</td>
                                                    <td class="text-danger fw-bold">Send</td>
                                                    <td><img src="{{ asset('assets/avatars') }}/{{ $transaction->avatar->image }}"
                                                            style="width: 3rem"></td>
                                                    <td>{{ $transaction->date }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($user->receives as $receive)
                                                <tr>
                                                    <th scope="row">{{ $number++ }}</th>
                                                    <td>{{ $receive->user->name }}</td>
                                                    <td class="text-success fw-bold">Received</td>
                                                    <td><img src="{{ asset('assets/avatars') }}/{{ $receive->avatar->image }}"
                                                            style="width: 3rem"></td>
                                                    <td>{{ $receive->date }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                        {{-- TOPUP SECTION --}}
                        <div class="col-sm-8 border shadow-sm rounded-3 text-center mt-3 bg-dark p-0" id="topup"
                            @if (Session::has('topupSess')) style="display: block" @endif style="display: none">
                            <form action="{{ route('topup', $user) }}" method="post">
                                @csrf
                                <button type="submit" class="fw-bold text-light py-4 btn btn-dark w-100">CLICK
                                    TO ADD 100
                                    COINS</button>
                            </form>
                        </div>
                        {{-- SETTING SECTION --}}
                        <div class="col-sm-8 border shadow-sm rounded-3 text-center mt-3 bg-dark text-light py-3" id="setting"
                            @if (Session::has('visibleSess')) style="display: block" @endif style="display: none">
                            <h2 class="fs-3 fw-bold">Current Visibility: </h2>
                            @if ($user->hidden)
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <h3 class="text-danger fw-bold">HIDDEN</h3>
                                    <form action="{{ route('confirm_visible') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-dark">
                                            <i class="fa-solid fa-eye-slash pb-3 fa-xl text-secondary"></i>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <h3 class="text-success fw-bold">VISIBLE</h3>
                                    <form action="{{ route('confirm_hidden') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-dark">
                                            <i class="fa-solid fa-eye pb-3 fa-xl text-secondary"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endauth
            <div @auth
                    @if ($user->id == auth()->user()->id) style="display: none"
                @else
                style="display: block" @endif
                    @endauth @guest style="display: block" @endguest>
                    <div class="border shadow-sm rounded-3 text-center position-relative">
                        <div class="d-flex align-items-center justify-content-evenly">
                            <div class="">
                                <img src="{{ asset('assets/avatars') }}/{{ $user->photo_profile }}"
                                    class="card-img-top mt-3" style="width: 12rem">
                                <h2 class="fw-bold mt-2">{{ $user->name }}</h2>
                                <h3 class="fs-4 fw-bold" style="color: gray">{{ $user->gender }}</h3>
                            </div>
                            <div class="">
                                <h2 class="fw-bold mb-4">DETAILS</h2>
                                <table class="table text-left">
                                    <tbody>
                                        <tr>
                                            <th scope="row"><i class="fa-solid fa-envelope fa-xl pb-2"></i></th>
                                            <td>
                                                <h5 class="text-left">{{ $user->email }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="fa-solid fa-mobile fa-xl pb-2"></i></th>
                                            <td>
                                                <h5 class="text-left">{{ $user->number }}</h5>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row"><i class="fa-solid fa-location-dot fa-xl pb2"></i></i></th>
                                            <td>
                                                <h5 class="text-left">{{ $user->address }}</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @auth
                                @php
                                    $wishlist = auth()
                                        ->user()
                                        ->wishlists()
                                        ->where('user_id_wishlisted', '=', $user->id)
                                        ->first();
                                @endphp
                                <div class="position-absolute" style="top: 1rem; right: 2rem;">
                                    <form action="{{ route('add_friend', $user) }}" method="post">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-light fs-2 
                                        @if ($wishlist) text-danger
                                        @else
                                        text-secondary @endif
                                        "><i
                                                class="fa-solid fa-heart fa-xl"></i></button>
                                    </form>
                                </div>
                            @endauth
                        </div>
                        <div class="mt-3 mb-3">
                            <h3 class="fw-bold text-secondary">HOBBIES</h3>
                            <div class="row d-flex justify-content-center">
                                @foreach ($user->headerHobbies as $header)
                                    <div class="col rounded-2 mx-3 bg-secondary text-light shadow-sm py-2 border">
                                        <img src="{{ asset('assets/hobbies') }}/{{ $header->hobby->image }}" alt=""
                                            style="width: 5rem">
                                        <span class="fw-bold fs-5" style="margin-left: 1rem">
                                            {{ $header->hobby->activity }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div @auth
                        @if ($user->id == auth()->user()->id) style="display: none"
                    @else
                    style="display: block" @endif
                        @endauth @guest style="display: block" @endguest>
                        <div class="border shadow-sm rounded-3 text-center mt-3 py-4 px-4 bg-dark" id="collections" style>
                            <h3 class="fw-bold mt-2 text-light mb-3">COLLECTIONS</h3>
                            @if (!$user->collections->isEmpty())
                                <div class="overflow-auto" style="max-height: 35rem">
                                    <div class="row row-cols-1 row-cols-md-4">
                                        @foreach ($user->collections as $collection)
                                            <div class="col">
                                                <x-collection-card :collection="$collection"></x-collection-card>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <h3 class="text-light">{{ $user->name }}'s collection is empty</h3>
                                    <i class="fa-solid fa-face-sad-tear text-light fa-xl pb-1"></i>
                                </div>
                            @endif
                            @if (!$user->transactions->isEmpty() || !$user->receives->isEmpty())
                                <h3 class="fw-bold mt-4 text-light mb-3">TRANSACTIONS</h3>
                                <div class="overflow-auto" style="max-height: 20rem">
                                    <table class="table table-dark table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Avatar</th>
                                                <th scope="col">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->transactions as $transaction)
                                                <tr>
                                                    <th scope="row">{{ $number++ }}</th>
                                                    <td>{{ $transaction->user_sent->name }}</td>
                                                    <td class="text-danger fw-bold">Send</td>
                                                    <td><img src="{{ asset('assets/avatars') }}/{{ $transaction->avatar->image }}"
                                                            style="width: 3rem"></td>
                                                    <td>{{ $transaction->date }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($user->receives as $receive)
                                                <tr>
                                                    <th scope="row">{{ $number++ }}</th>
                                                    <td>{{ $receive->user->name }}</td>
                                                    <td class="text-success fw-bold">Received</td>
                                                    <td><img src="{{ asset('assets/avatars') }}/{{ $receive->avatar->image }}"
                                                            style="width: 3rem"></td>
                                                    <td>{{ $receive->date }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
        @endsection
