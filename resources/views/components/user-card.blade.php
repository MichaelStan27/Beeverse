@props(['user'])

<div class="card mb-3 shadow-sm">
    <div class="row g-0">
        <div class="col-md-2 text-center d-flex align-items-center justify-content-center">
            <img src="{{ asset('assets/avatars/') }}/{{ $user->photo_profile }}" class="img-fluid rounded-start"
                style="width: 8rem" alt="...">
        </div>
        <div class="col-md-10">
            <div class="card-body">
                <h5 class="card-title mb-0 fw-bolder fs-4">{{ $user->name }}</h5>
                <p class="card-text"><small class="text-muted">{{ $user->gender }}</small></p>
                @foreach ($user->headerHobbies as $header)
                    <div class="d-inline">
                        <img src="{{ asset('assets/hobbies') }}/{{ $header->hobby->image }}" alt=""
                            style="width: 4rem">
                        <span class="fw-bold" style="margin-right: 1rem">
                            {{ $header->hobby->activity }}
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
