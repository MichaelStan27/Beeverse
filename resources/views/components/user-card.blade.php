@props(['user', 'collections'])

<a href="{{ route('profile', $user) }}" class="text-dark" style="text-decoration: none;">
    <div class="card mb-3 shadow-sm">
        <div class="row g-0">
            <div class="col-md-2 text-center d-flex align-items-center justify-content-center">
                <img src="{{ asset('assets/avatars/') }}/{{ $user->photo_profile }}" class="img-fluid rounded-start"
                    style="width: 8rem" alt="...">
            </div>
            <div class="col-md-10">
                <div class="card-body d-flex gap-2">
                    <div class="w-50">
                        <h5 class="card-title mb-0 fw-bolder fs-4">{{ $user->name }}</h5>
                        <p class="card-text"><small class="text-muted">{{ $user->gender }}</small></p>
                        <p class="card-text fw-bold text-secondary fs-5">Collections</p>
                        <div class="d-flex gap-4 fw-bold mb-3 overflow-auto">
                            @forelse ($collections as $collection)
                                <img src="{{ asset('assets/avatars') }}/{{ $collection->avatar->image }}"
                                    style="width: 4rem">
                            @empty
                                <h5 class="text-secondary">{{ $user->name }}'s collection is empty</h5>
                            @endforelse
                        </div>
                    </div>
                    <div class="w-50 px-2 d-flex justify-content-center align-items-center overflow-auto">
                        <div class="d-flex flex-wrap gap-3">
                            @foreach ($user->headerHobbies as $header)
                                <div class="border rounded-2 shadow-sm p-2 bg-secondary">
                                    <img src="{{ asset('assets/hobbies') }}/{{ $header->hobby->image }}" alt=""
                                        class="" style="width: 4rem">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
