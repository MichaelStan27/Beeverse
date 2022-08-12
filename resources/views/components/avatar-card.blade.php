@props(['avatar'])

<div class="card mb-lg-4 text-center d-flex align-items-center justify-content-center shadow-sm" style="width: 18rem;"
    id="{{ $avatar->id }}">
    <img src="{{ asset('assets/avatars') }}/{{ $avatar->image }}" class="card-img-top mt-3" style="width: 12rem">
    <div class="card-body">
        <h5 class="card-title fw-bold fs-4">{{ $avatar->name }}</h5>
        <div class="d-flex justify-content-center gap-2 mb-3">
            <i class="fa-solid fa-coins pt-1"></i>
            <p class="card-text fs-6 fw-bold" style="color: gray">{{ $avatar->price_format }}</p>
        </div>
        <form action="{{ route('check', $avatar) }}" method="post">
            @csrf
            <button type="submit" class="btn btn-dark" style="width: 10rem">
                {{ __('BUY') }}
            </button>
        </form>
    </div>
</div>
