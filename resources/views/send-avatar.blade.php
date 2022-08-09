@extends('layout.main')

@section('title', 'Send Avatar')

@section('content')
    <div class="flex justify-content-center mx-auto" style="padding: 3rem">
        <h1 class="text-center pb-3 fw-bold" style="color: gray">SEND AVATAR</h1>
        <div class="card mb-3 w-75 mx-auto rounded-2 shadow-sm p-3">
            <div class="row g-0">
                <div class="col-md-4 text-center d-flex align-items-center justify-content-center">
                    <img src="{{ asset('assets/avatars') }}/{{ $avatar->image }}" class="img-fluid rounded-start">
                </div>
                <div class="col-md-8 d-flex align-items-center justify-content-center">
                    <div class="card-body h-100">
                        <h5 class="card-title fs-1 fw-bold mt-3 text-center">{{ $avatar->name }}</h5>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
