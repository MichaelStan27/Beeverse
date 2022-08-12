@php
if (Session::has('data')) {
    $data = Session::get('data');
    $feeAmount = $data['feeAmount'];
}
@endphp

@extends('layout.main')

@section('title', __('Register'))

@section('content')
    <div class="w-75 flex justify-content-center mx-auto my-5 border shadow-sm rounded-4 p-5">
        <h1 class="mb-4 fw-bold">{{ __('Sign Up') }}</h1>
        <form action="{{ route('register') }}" method="post">
            @csrf
            <input type="hidden" name="feeAmount" value="{{ $feeAmount }}">
            <div class="form-floating mb-3">
                <input class="form-control @error('name') is-invalid @enderror" id="floatingName" name="name"
                    autocomplete="off" placeholder="Name"
                    @if (isset($data)) value="{{ $data['name'] }}" @else value="{{ old('name') }}" @endif>
                <label for="floatingName">{{ __('Name') }}</label>
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-control @error('gender') is-invalid @enderror" id="gender" name="gender">
                    <option value="" selected disabled>{{ __('Select Your Gender') }}</option>
                    <option @if ((isset($data) && $data['gender'] == 'Male') || old('gender') == 'Male') selected @endif>
                        {{ __('Male') }}</option>
                    <option @if ((isset($data) && $data['gender'] == 'Female') || old('gender') == 'Female') selected @endif>{{ __('Female') }}</option>
                </select>
                @error('gender')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <select class="form-control @error('hobbies') is-invalid @enderror" multiple id="hobbies"
                    name="hobbies[]">
                    <option value="" disabled>{{ __('Select Your Hobby') }} (min:3)</option>
                    @foreach ($hobbies as $hobby)
                        @if (isset($data))
                            <option value="{{ $hobby->id }}"
                                {{ in_array($hobby->id, $data['hobbies']) ? 'selected' : '' }}>
                                {{ __($hobby->activity) }}
                            </option>
                        @else
                            <option value="{{ $hobby->id }}"
                                {{ collect(old('hobbies'))->contains($hobby->id) ? 'selected' : '' }}>
                                {{ __($hobby->activity) }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('hobbies')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="basic-url" class="form-label">{{ __('Instagram Username') }}</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3">https://instagram.com/</span>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="basic-url"
                        aria-describedby="basic-addon3" name="username" autocomplete="off"
                        @if (isset($data)) value="{{ $data['username'] }}" @else value="{{ old('username') }}" @endif>
                </div>
                @error('username')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="number" class="form-control @error('number') is-invalid @enderror" id="floatingNumber"
                    name="number" autocomplete="off" placeholder="Number"
                    @if (isset($data)) value="{{ $data['number'] }}" @else value="{{ old('number') }}" @endif>
                <label for="floatingNumber">{{ __('Mobile Number') }}</label>
                @error('number')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input class="form-control @error('address') is-invalid @enderror" id="floatingAddress" name="address"
                    placeholder="address" autocomplete="off"
                    @if (isset($data)) value="{{ $data['address'] }}" @else value="{{ old('address') }}" @endif>
                <label for="floatingAddress">{{ __('Address') }}</label>
                @error('address')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingEmail"
                    name="email" placeholder="name@example.com" autocomplete="off"
                    @if (isset($data)) value="{{ $data['email'] }}" @else value="{{ old('email') }}" @endif>
                <label for="floatingEmail">{{ __('Email Address') }}</label>
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword"
                    name="password" placeholder="Password"
                    @if (isset($data)) value="{{ $data['password'] }}" @endif>
                <label for="floatingPassword">{{ __('Password') }}</label>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                    id="floatingPasswordC" name="password_confirmation" placeholder="Password Confirm"
                    @if (isset($data)) value="{{ $data['password_confirmation'] }}" @endif>
                <label for="floatingPasswordC">{{ __('Confirm') }} {{ __('Password') }}</label>
                @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <h5 class="fw-bold">{{ __('Registration') }}
                    <span style="color: gray">
                        ({{ __('fee') }}: {{ __('IDR') }}
                        @if (App::isLocale('en'))
                            {{ number_format($feeAmount) }})
                        @else
                            {{ number_format($feeAmount, 0, null, '.') }})
                        @endif
                    </span>
                </h5>
            </div>
            <button type="submit" class="btn btn-dark">{{ __('Register') }}</button>
        </form>
    </div>
@endsection
