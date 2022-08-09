@props(['avatar'])

<div class="card mb-lg-4 text-center d-flex align-items-center justify-content-center shadow-sm" style="width: 18rem;">
    <img src="{{ asset('assets/avatars') }}/{{ $avatar->image }}" class="card-img-top" style="width: 12rem">
    <div class="card-body">
        <h5 class="card-title fw-bold fs-4">{{ $avatar->name }}</h5>
        <p class="card-text fs-6 fw-bold" style="color: gray">{{ $avatar->price_format }}</p>
        <a href="#" class="btn btn-dark" style="width: 10rem">BUY</a>
    </div>
</div>
