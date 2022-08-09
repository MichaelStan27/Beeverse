<form action="" method="post" class="border shadow-sm rounded-3 py-3">
    <h3 class="fw-bold mb-3 text-center">FILTER</h3>
    @csrf
    <div class="w-75 mx-auto">
        <h5 class="">Gender</h5>
        <ul class="list-unstyled mb-2">
            <li class="">
                <div class="mb-3 form-check w-75 mx-auto">
                    <input type="checkbox" class="form-check-input mr-0" id="Male" value="1">
                    <label class="form-check-label" for="Male" name="gender[]" style="color: gray">Male</label>
                </div>
            </li>
            <li class="">
                <div class="mb-3 form-check w-75 mx-auto">
                    <input type="checkbox" class="form-check-input mr-0" id="Female">
                    <label class="form-check-label" for="Female" name="gender[]" style="color: gray">Female</label>
                </div>
            </li>
        </ul>
        <h5 class="">Hobby</h5>
        <ul class="list-unstyled mb-2">
            @foreach ($hobbies as $hobby)
                <li class="">
                    <div class="mb-3 form-check w-75 mx-auto">
                        <input type="checkbox" class="form-check-input mr-0" id="{{ $hobby->activity }}"
                            value="{{ $hobby->id }}">
                        <label class="form-check-label" for="{{ $hobby->activity }}" name="hobby[]"
                            style="color: gray">{{ $hobby->activity }}</label>
                    </div>
                </li>
            @endforeach
        </ul>
        <button type="submit" class="btn btn-dark px-4 w-100">Filter</button>
    </div>
</form>
