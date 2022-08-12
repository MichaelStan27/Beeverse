@php
$number = 1;
@endphp

@extends('layout.main')

@section('title', __('Profile'))

@section('content')
    <div class="flex justify-content-center mx-auto" style="padding: 3rem">
        <h1 class="text-center pb-3 fw-bold" style="color: gray">{{ __('PROFILE') }}</h1>
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
                                    <h3 class="fs-4 fw-bold" style="color: gray">{{ __($user->gender) }}</h3>
                                    <a href="https://www.instagram.com/{{ $user->ig_username }}" class="text-dark"
                                        style="text-decoration: none;">
                                        <div class="d-flex gap-2 justify-content-center align-items-center">
                                            <i class="fa-brands fa-instagram fa-lg pb-3 fw-bold"></i>
                                            <p class="text-secondary fs-5 fw-bold">{{ $user->ig_username }}</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="">
                                    <div class="d-flex gap-4 fw-bold mb-3 mt-2">
                                        <div class="">
                                            <h4 class="fs-4 fw-bold">
                                                {{ __('Followers') }}
                                            </h4>
                                            <h5 class="text-secondary fw-bold">
                                                {{ $followers->count() }}
                                            </h5>
                                        </div>
                                        <div class="">
                                            <h4 class="fs-4 fw-bold">
                                                {{ __('Following') }}
                                            </h4>
                                            <h5 class="text-secondary fw-bold">
                                                {{ $user->wishlists()->count() }}
                                            </h5>
                                        </div>
                                    </div>
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
                                            <button type="submit"
                                                class="btn btn-secondary w-100">{{ __('Edit Profile') }}</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-3 mb-3">
                                <h3 class="fw-bold text-secondary">{{ __('HOBBIES') }}</h3>
                                <div class="row d-flex justify-content-center gap-1">
                                    @foreach ($user->headerHobbies as $header)
                                        <div class="col border rounded-2 mx-3 bg-secondary text-light shadow-sm py-2">
                                            <img src="{{ asset('assets/hobbies') }}/{{ $header->hobby->image }}"
                                                alt="" style="width: 5rem">
                                            <span class="fw-bold fs-5" style="margin-left: 1rem">
                                                {{ __($header->hobby->activity) }}
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
                                    {{ __('COLLECTIONS') }}
                                </a>
                            </div>
                            <div class="border-bottom fw-bold">
                                <a href="#" class="btn w-100 py-4 fw-bold" id="topupBtn"
                                    @if (Session::has('topupSess')) style="background-color: black; color: white;" @endif>
                                    {{ __('TOP UP') }}
                                </a>
                            </div>
                            <div class="border-bottom fw-bold">
                                <a href="#" class="btn w-100 py-4 fw-bold" id="wishlistBtn"
                                    @if (Session::has('ingSes') || Session::has('ersSes')) style="background-color: black; color: white;" @endif>{{ __('WISHLISTS') }}</a>
                            </div>
                            <div class="border-bottom fw-bold">
                                <a href="#" class="btn w-100 py-4 fw-bold" id="settingBtn"
                                    @if (Session::has('visibleSess')) style="background-color: black; color: white;" @endif>
                                    {{ __('SETTINGS') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        {{-- COLLECTIONS CARD SECTION --}}
                        <div class="col-sm-8 border shadow-sm rounded-3 text-center mt-3 py-4 px-4 bg-dark" id="collections"
                            style="display: none">
                            <h3 class="fw-bold mt-2 text-light mb-3">{{ __('COLLECTIONS') }}</h3>
                            @if (!$user->collections->isEmpty())
                                <div style="max-height: 40rem">
                                    <div class="row row-cols-1 row-cols-md-4" class="overflow-y: auto">
                                        @foreach ($user->collections as $collection)
                                            <div class="col">
                                                <x-collection-card :collection="$collection"></x-collection-card>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    @if (App::isLocale('en'))
                                        <h3 class="text-light">{{ $user->name }}'s collection is empty</h3>
                                    @else
                                        <h3 class="text-light">Koleksi anda kosong</h3>
                                    @endif
                                    <i class="fa-solid fa-face-sad-tear text-light fa-xl pb-1"></i>
                                </div>
                            @endif
                            @if (!$user->transactions->isEmpty() || !$user->receives->isEmpty())
                                {{-- TRANSACTIONS SECTION --}}
                                <h3 class="fw-bold mt-4 text-light mb-3">{{ __('TRANSACTIONS') }}</h3>
                                <div class="overflow-auto" style="max-height: 25rem">
                                    <table class="table table-dark table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('User') }}</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Avatar</th>
                                                <th scope="col">{{ __('Date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->transactions as $transaction)
                                                <tr>
                                                    <th scope="row">{{ $number++ }}</th>
                                                    <td>{{ $transaction->user_sent->name }}</td>
                                                    <td class="text-danger fw-bold">{{ __('Send') }}</td>
                                                    <td><img src="{{ asset('assets/avatars') }}/{{ $transaction->avatar->image }}"
                                                            style="width: 3rem"></td>
                                                    <td>{{ $transaction->date }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($user->receives as $receive)
                                                <tr>
                                                    <th scope="row">{{ $number++ }}</th>
                                                    <td>{{ $receive->user->name }}</td>
                                                    <td class="text-success fw-bold">{{ __('Received') }}</td>
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
                                <button type="submit" class="fw-bold text-light py-4 btn btn-dark w-100">
                                    {{ __('CLICK TO ADD 100 COINS') }}</button>
                            </form>
                        </div>
                        {{-- SETTING SECTION --}}
                        <div class="col-sm-8 border shadow-sm rounded-3 text-center mt-3 bg-dark text-light py-3"
                            id="setting" @if (Session::has('visibleSess')) style="display: block" @endif
                            style="display: none">
                            <h2 class="fs-3 fw-bold">{{ __('Current Visibility:') }} </h2>
                            @if ($user->hidden)
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <h3 class="text-danger fw-bold">{{ __('HIDDEN') }}</h3>
                                    <form action="{{ route('confirm_visible') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-dark">
                                            <i class="fa-solid fa-eye-slash pb-3 fa-xl text-secondary"></i>
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="d-flex justify-content-center align-items-center gap-2">
                                    <h3 class="text-success fw-bold">{{ __('VISIBLE') }}</h3>
                                    <form action="{{ route('confirm_hidden') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-dark">
                                            <i class="fa-solid fa-eye pb-3 fa-xl text-secondary"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        {{-- WISHLIST SECTION --}}
                        <div class="col-sm-8 border shadow-sm rounded-3 mt-3 bg-dark text-light py-3 px-4"
                            style="@if (Session::has('ingSes') || Session::has('ersSes')) display: block @else display: none @endif"
                            id="wishlists">
                            <h3 class="fw-bold">{{ __('WISHLISTS') }}</h3>
                            <div class="d-flex px-2 justify-content-evenly mb-4">
                                <form action="{{ route('tab_followers', auth()->user()) }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="@if (Session::has('ersSes')) active @endif btn btn-dark fw-bold fs-4 border-light"
                                        style="padding-inline: 10rem" id="tabfollowers">{{ __('Followers') }}</button>
                                </form>
                                <form action="{{ route('tab_following', auth()->user()) }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class=" @if (Session::has('ingSes')) active @endif btn btn-dark fw-bold fs-4 border-light"
                                        style="padding-inline: 10rem" id="tabfollowing">{{ __('Following') }}</button>
                                </form>
                            </div>
                            @if (Session::has('ingSes'))
                                <div class="overflow-auto px-2" style="max-height: 30rem" id="followingCard">
                                    @forelse ($user->wishlists as $following)
                                        <x-user-card :user="$following->user_wishlist" :collections="$following->user_wishlist->collections"></x-user-card>
                                    @empty
                                        <div class="d-flex justify-content-center gap-2">
                                            <h3 class="">{{ __("You haven't follow any user yet") }}</h3>
                                            <i class="fa-solid fa-heart-crack fa-xl pt-3"></i>
                                        </div>
                                    @endforelse
                                </div>
                            @elseif (Session::has('ersSes'))
                                <div class="overflow-auto px-2" style="max-height: 30rem" id="followerCard">
                                    @forelse ($followers as $follower)
                                        <x-user-card :user="$follower->user" :collections="$follower->user->collections"></x-user-card>
                                    @empty
                                        <div class="d-flex justify-content-center gap-2">
                                            <h3 class="">{{ __("You haven't been followed by any user yet") }}</h3>
                                            <i class="fa-solid fa-heart-crack fa-xl pt-3"></i>
                                        </div>
                                    @endforelse
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
                                <h3 class="fs-4 fw-bold" style="color: gray">{{ __($user->gender) }}</h3>
                                <a href="https://www.instagram.com/{{ $user->ig_username }}" class="text-dark"
                                    style="text-decoration: none;">
                                    <div class="d-flex gap-2 justify-content-center align-items-center">
                                        <i class="fa-brands fa-instagram fa-lg pb-3 fw-bold"></i>
                                        <p class="text-secondary fs-5 fw-bold">{{ $user->ig_username }}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="">
                                <div class="">
                                    <div class="d-flex gap-4 fw-bold mb-3 mt-2">
                                        <div class="">
                                            <h4 class="fs-4 fw-bold">
                                                {{ __('Followers') }}
                                            </h4>
                                            <h5 class="text-secondary fw-bold">
                                                {{ $followers->count() }}
                                            </h5>
                                        </div>
                                        <div class="">
                                            <h4 class="fs-4 fw-bold">
                                                {{ __('Following') }}
                                            </h4>
                                            <h5 class="text-secondary fw-bold">
                                                {{ $user->wishlists()->count() }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
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
                            <h3 class="fw-bold text-secondary">{{ __('HOBBIES') }}</h3>
                            <div class="row d-flex justify-content-center">
                                @foreach ($user->headerHobbies as $header)
                                    <div class="col rounded-2 mx-3 bg-secondary text-light shadow-sm py-2 border">
                                        <img src="{{ asset('assets/hobbies') }}/{{ $header->hobby->image }}" alt=""
                                            style="width: 5rem">
                                        <span class="fw-bold fs-5" style="margin-left: 1rem">
                                            {{ __($header->hobby->activity) }}
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
                            <h3 class="fw-bold mt-2 text-light mb-3">{{ __('COLLECTIONS') }}</h3>
                            @if (!$user->collections->isEmpty())
                                <div style="max-height: 40rem;">
                                    <div class="row row-cols-1 row-cols-md-4" style="overflow-y: auto">
                                        @foreach ($user->collections as $collection)
                                            <div class="col">
                                                <x-collection-card :collection="$collection"></x-collection-card>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    @if (App::isLocale('en'))
                                        <h3 class="text-light">{{ $user->name }}'s collection is empty</h3>
                                    @else
                                        <h3 class="text-light">Koleksi {{ $user->name }} kosong</h3>
                                    @endif
                                    <i class="fa-solid fa-face-sad-tear text-light fa-xl pb-1"></i>
                                </div>
                            @endif
                            @if (!$user->transactions->isEmpty() || !$user->receives->isEmpty())
                                <h3 class="fw-bold mt-4 text-light mb-3">{{ __('TRANSACTIONS') }}</h3>
                                <div class="overflow-auto" style="max-height: 25rem">
                                    <table class="table table-dark table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('User') }}</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Avatar</th>
                                                <th scope="col">{{ __('Date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($user->transactions as $transaction)
                                                <tr>
                                                    <th scope="row">{{ $number++ }}</th>
                                                    <td>{{ $transaction->user_sent->name }}</td>
                                                    <td class="text-danger fw-bold">{{ __('Send') }}</td>
                                                    <td><img src="{{ asset('assets/avatars') }}/{{ $transaction->avatar->image }}"
                                                            style="width: 3rem"></td>
                                                    <td>{{ $transaction->date }}</td>
                                                </tr>
                                            @endforeach
                                            @foreach ($user->receives as $receive)
                                                <tr>
                                                    <th scope="row">{{ $number++ }}</th>
                                                    <td>{{ $receive->user->name }}</td>
                                                    <td class="text-success fw-bold">{{ __('Received') }}</td>
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
