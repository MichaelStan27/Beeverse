@extends('layout.main')

@section('title', 'Dashboard')

@section('content')
    <div class="flex justify-content-center mx-auto" style="padding: 3rem">
        <div class="">
            <div class="row">
                <div class="col-3">
                    @include('partials.filter-card')
                </div>
                <div class="col-9 px-4">
                    @forelse ($users as $user)
                        @auth
                            @if ($user->id == auth()->user()->id)
                                @continue
                            @endif
                        @endauth
                        <x-user-card :user="$user"></x-user-card>
                    @empty
                        <h3 class="text-center fw-bold text-secondary" style="margin-top: 12rem">NO USER FOUND</h3>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="mt-4 d-flex justify-content-end">
            {{ $users->links() }}
        </div>
    </div>
@endsection
