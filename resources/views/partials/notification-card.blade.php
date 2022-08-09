@if (Session::has('amount'))
    <div class="fixed-top w-25 mt-5" style="margin-left: 41rem">
        <div class="card" style="width: 18rem;" id="confirmation-card">
            <div class="card-body">
                <h5 class="card-title text-danger fw-bold w-100 text-center fs-3">Error</h5>
                <h6 class="card-subtitle mb-2 text-muted text-center">Sorry you are overpaid IDR
                    {{ number_format(session('amount')) }}
                </h6>
                <p class="card-text text-center">Would you like to enter the balance?</p>
                <form action="{{ route('convert', auth()->user()) }}" method="post">
                    @csrf
                    <input type="hidden" name="converted" value="{{ session('amount') }}">
                    <button type="submit" class="btn w-100 mb-3" style="background-color: greenyellow"
                        id="yesBtn">Yes</button>
                    <a href="#fee" class="btn btn-danger w-100" id="noBtn">No</a>
                </form>
            </div>
        </div>
    </div>
@elseif (Session::has('amount_underpaid'))
    <div class="fixed-top w-25 mt-5" style="margin-left: 41rem">
        <div class="card" style="width: 18rem;" id="notif-card">
            <div class="card-body">
                <h5 class="card-title text-danger fw-bold w-100 text-center">Error</h5>
                <h6 class="card-subtitle mb-2 text-muted text-center">Sorry you are underpaid IDR
                    {{ number_format(session('amount_underpaid')) }}
                </h6>
            </div>
        </div>
    </div>
@elseif (Session::has('message'))
    <div class="fixed-top w-25 mt-5" style="margin-left: 41rem">
        <div class="card" style="width: 18rem;" id="notif-card">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted text-center mt-2">{{ session('message') }}
                </h6>
            </div>
        </div>
    </div>
@elseif (Session::has('check'))
    <div class="w-25">
        <div class="card text-bg-dark"
            style="
            width: 19rem;
            position: fixed;
            left: 50%;
            top: 25%;
            z-index: 1000 !important;
            transform: translateX(-50%);
            "
            id="buySend-card">
            <div class="card-body">
                <div class="d-flex justify-content-end">
                    <a href="#" class="text-light" id="xBtn">
                        <i class="fa-solid fa-x"></i>
                    </a>
                </div>
                <h5 class="card-title text-light fw-bold w-100 text-center fs-3">Buy / Send</h5>
                <p class="card-text text-center">What do you want to do with this avatar?</p>
                <div class="text-center d-flex align-items-center justify-content-center mb-4">
                    <img src="{{ asset('assets/avatars') }}/{{ session('check') }}" style="width: 8rem">
                </div>
                <a href="#" class="btn btn-outline-light w-100 mb-2" id="buyBtn">Buy</a>
                <a href="#" class="btn btn-outline-light w-100" id="sendBtn">Send</a>
            </div>
        </div>
    </div>
@endif
