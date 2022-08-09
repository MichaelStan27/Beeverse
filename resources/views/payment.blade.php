@if (Session::has('feeAmount'))
    @php
        $feeAmount = Session::get('feeAmount');
    @endphp
@else
    @php
        $feeAmount = random_int(100000, 125000);
    @endphp
@endif

@extends('layout.main')

@section('title', 'payment')

@section('content')
    @if (!$user->is_paying)
        <div class="w-75 flex justify-content-center mx-auto my-5 border shadow-sm rounded-4 p-5">
            <h1 class="mb-4 fw-bold">Payment</h1>
            <form action="{{ route('payment', $user) }}" method="post">
                @csrf
                <input type="hidden" name="feeAmount" value="{{ $feeAmount }}">
                <div class="mb-3">
                    <h5 class="fw-bold">Registration
                        <span style="color: gray">
                            (fee: IDR
                            {{ number_format($feeAmount) }})
                        </span>
                    </h5>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon3">IDR</span>
                        <input type="number" class="form-control @error('fee') is-invalid @enderror" id="fee"
                            aria-describedby="basic-addon3" name="fee">
                    </div>
                    <p class="text-danger" id="errorFeeMsg" style="display: none">Please Fill in the number
                        again
                    </p>
                    @error('fee')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-dark">Pay</button>
            </form>
        </div>
    @else
        <div class="w-75 flex justify-content-center mx-auto my-5 p-5">
            <h1 class="mb-4 fw-bold text-center">UNAUTHORIZED</h1>
        </div>
    @endif
@endsection
