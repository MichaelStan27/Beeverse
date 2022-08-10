@php
$number = 1;
@endphp

@extends('layout.main')

@section('title', 'Profile')

@section('content')
    <div class="flex justify-content-center mx-auto" style="padding: 3rem">
        <h1 class="text-center pb-3 fw-bold" style="color: gray">PROFILE</h1>
        <div class="text-center">
            @if ($user->id == auth()->user()->id)
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
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 border shadow-sm rounded-3 px-0" style="max-height: 18.5rem">
                        <div class="border-bottom fw-bold">
                            <a href="#" class="btn w-100 py-4 fw-bold" id="collectionBtn">
                                COLLECTIONS
                            </a>
                        </div>
                        <div class="border-bottom fw-bold">
                            <a href="#" class="btn w-100 py-4 fw-bold">
                                TOP UP
                            </a>
                        </div>
                        <div class="border-bottom fw-bold">
                            <a href="#" class="btn w-100 py-4 fw-bold">
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
                    <div class="col-sm-8 border shadow-sm rounded-3 text-center mt-3 py-4 px-4 bg-dark" id="collections"
                        style="display: none">
                        <h3 class="fw-bold mt-2 text-light mb-3">COLLECTIONS</h3>
                        @if (!$user->collections->isEmpty())
                            <div class="row row-cols-1 row-cols-md-4">
                                @foreach ($user->collections as $collection)
                                    <div class="col">
                                        <x-collection-card :collection="$collection"></x-collection-card>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <h3 class="text-light">{{ $user->name }}'s collection is empty</h3>
                                <i class="fa-solid fa-face-sad-tear text-light fa-xl pb-1"></i>
                            </div>
                        @endif
                        @if (!$user->transactions->isEmpty() || !$user->receives->isEmpty())
                            <h3 class="fw-bold mt-4 text-light mb-3">TRANSACTIONS</h3>
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
                        @endif
                    </div>
                </div>
            @else
                <div class="">
                    <div class="border shadow-sm rounded-3 text-center">
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
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="border shadow-sm rounded-3 text-center mt-3 py-4 px-4 bg-dark" id="collections" style>
                        <h3 class="fw-bold mt-2 text-light mb-3">COLLECTIONS</h3>
                        @if (!$user->collections->isEmpty())
                            <div class="row row-cols-1 row-cols-md-4">
                                @foreach ($user->collections as $collection)
                                    <div class="col">
                                        <x-collection-card :collection="$collection"></x-collection-card>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <h3 class="text-light">{{ $user->name }}'s collection is empty</h3>
                                <i class="fa-solid fa-face-sad-tear text-light fa-xl pb-1"></i>
                            </div>
                        @endif
                        @if (!$user->transactions->isEmpty() || !$user->receives->isEmpty())
                            <h3 class="fw-bold mt-4 text-light mb-3">TRANSACTIONS</h3>
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
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection