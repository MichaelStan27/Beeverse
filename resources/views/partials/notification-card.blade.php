@if (Session::has('amount'))
    <div class="fixed-top mx-auto w-25 mt-5">
        <div class="card" style="width: 18rem;" id="confirmation-card">
            <div class="card-body">
                <h5 class="card-title text-danger fw-bold w-100 text-center">Error Message</h5>
                <h6 class="card-subtitle mb-2 text-muted text-center">Sorry you are overpaid IDR
                    {{ number_format(session('amount')) }}
                </h6>
                <p class="card-text text-center">Would you like to enter a balance?</p>
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
    <div class="fixed-top mx-auto w-25 mt-5">
        <div class="card" style="width: 18rem;" id="error-card">
            <div class="card-body">
                <h5 class="card-title text-danger fw-bold w-100 text-center">Error Message</h5>
                <h6 class="card-subtitle mb-2 text-muted text-center">Sorry you are underpaid IDR
                    {{ number_format(session('amount_underpaid')) }}
                </h6>
            </div>
        </div>
    </div>
@endif
