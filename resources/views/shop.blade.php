@extends('layout.main')

@section('title', 'Shop')

@section('content')
    <div class="flex justify-content-center mx-auto" style="padding: 3rem">
        <h1 class="text-center pb-3 fw-bold" style="color: gray">SHOP</h1>
        <div class="row row-cols-1 row-cols-md-4">
            @foreach ($avatars as $avatar)
                <div class="col">
                    <x-avatar-card :avatar="$avatar"></x-avatar-card>
                </div>
            @endforeach
        </div>
        <div class="mt-3 d-flex justify-content-end px-4" style="margin-right: 2rem">
            {{ $avatars->links() }}
        </div>
    </div>
@endsection
