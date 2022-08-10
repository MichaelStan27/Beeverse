<form action="" method="post" class="border shadow-sm rounded-3 py-3 bg-dark text-light px-2">
    <h3 class="fw-bold mb-3 text-center">SEARCH</h3>
    @csrf
    <input class="form-control mx-auto mb-4" type="search" placeholder="Keyword" aria-label="Search" style="width: 18rem;">
    <div class="w-75 mx-auto">
        <h5 class="fw-bold">Gender</h5>
        <ul class="list-unstyled mb-2">
            <li class="">
                <div class="mb-3 form-check w-75 mx-auto">
                    <input type="checkbox" class="form-check-input mr-0" id="Male" value="1">
                    <label class="form-check-label" for="Male" name="gender[]">Male</label>
                </div>
            </li>
            <li class="">
                <div class="mb-3 form-check w-75 mx-auto">
                    <input type="checkbox" class="form-check-input mr-0" id="Female">
                    <label class="form-check-label" for="Female" name="gender[]">Female</label>
                </div>
            </li>
        </ul>
        <h5 class="fw-bold">Hobby</h5>
        <ul class="list-unstyled mb-2">
            @foreach ($hobbies as $hobby)
                <li class="">
                    <div class="mb-3 form-check w-75 mx-auto">
                        <input type="checkbox" class="form-check-input mr-0" id="{{ $hobby->activity }}"
                            value="{{ $hobby->id }}">
                        <label class="form-check-label" for="{{ $hobby->activity }}"
                            name="hobby[]">{{ $hobby->activity }}</label>
                    </div>
                </li>
            @endforeach
        </ul>
        <button type="submit" class="btn btn-light px-4 w-100 mb-2">Search</button>
    </div>
</form>
