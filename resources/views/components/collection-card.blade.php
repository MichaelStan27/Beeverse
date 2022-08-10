@props(['collection'])

<div class="rounded-2 border bg-light shadow-sm mb-3">
    <img src="{{ asset('assets/avatars') }}/{{ $collection->avatar->image }}" class="card-img-top mt-3"
        style="width: 10rem">
    <h4 class="fs-2 fw-bold">{{ $collection->avatar->name }}</h4>
    <h5 class="fs-6 fw-light" style="color: gray">Collected Since:
        <br>{{ $collection->collected_date }}
    </h5>
</div>
