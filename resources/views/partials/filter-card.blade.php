<form action="{{ route('search') }}" method="get" class="border shadow-sm rounded-3 py-3 bg-dark text-light px-2"
    id="formFilter">
    <h3 class="fw-bold mb-3 text-center">SEARCH</h3>
    @csrf
    <input class="form-control mx-auto mb-4" type="search" placeholder="Keyword" autocomplete="off" name="keyword"
        style="width: 18rem;" @if (isset($keyword)) value="{{ $keyword }}" @endif>
    <div class="w-75 mx-auto">
        <h5 class="fw-bold">Gender</h5>
        <ul class="list-unstyled mb-2">
            <li class="">
                <div class="mb-3 form-check w-75 mx-auto">
                    <input type="checkbox" class="form-check-input mr-0" id="Male" value="Male" name="gender[]"
                        @if (isset($genders) && in_array('Male', $genders)) checked @endif>
                    <label class="form-check-label" for="Male">Male</label>
                </div>
            </li>
            <li class="">
                <div class="mb-3 form-check w-75 mx-auto">
                    <input type="checkbox" class="form-check-input mr-0" id="Female" value="Female" name="gender[]"
                        @if (isset($genders) && in_array('Female', $genders)) checked @endif>
                    <label class="form-check-label" for="Female">Female</label>
                </div>
            </li>
        </ul>
        <h5 class="fw-bold">Hobby</h5>
        <ul class="list-unstyled mb-2">
            @foreach ($hobbies as $hobby)
                <li class="">
                    <div class="mb-3 form-check w-75 mx-auto">
                        <input type="checkbox" class="form-check-input mr-0" id="{{ $hobby->activity }}"
                            value="{{ $hobby->id }}" name="hobbies[]"
                            @if (isset($hobbiesQuery) && in_array($hobby->id, $hobbiesQuery)) checked @endif>
                        <label class="form-check-label" for="{{ $hobby->activity }}"
                            name="hobby[]">{{ $hobby->activity }}</label>
                    </div>
                </li>
            @endforeach
        </ul>
        <button type="submit" class="btn btn-light px-4 w-100 mb-2" id="searchBtn">Search</button>
    </div>
</form>
