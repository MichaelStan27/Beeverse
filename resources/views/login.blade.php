@extends('layout.main')

@section('title', __('Login'))

@section('content')
    <div class="w-75 flex justify-content-center mx-auto my-5 border shadow-sm rounded-4 p-5">
        <h1 class="mb-4 fw-bold">{{ __('Login') }}</h1>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    aria-describedby="emailHelp" autocomplete="off" value="{{ old('email') }}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password">
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember" name="remember">{{ __('Remember me') }}</label>
            </div>
            <button type="submit" class="btn btn-dark mb-3">{{ __('Login') }}</button>
        </form>
        <a href="{{ route('register') }}" style="color: black">{{ __("Didn't have an account?") }}</a>
    </div>
@endsection
