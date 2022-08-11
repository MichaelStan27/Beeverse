<nav class="navbar navbar-expand-lg border shadow-sm position-relative">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}" class="">
            <img src="{{ asset('assets/logo/logoname.png') }}" alt="" style="width: 8rem;" class="ms-5">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown position-absolute fw-bold" style="right: 7rem; top: 2rem;">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu py-0">
                                @can('see', auth()->user())
                                    <li>
                                        <div
                                            class="text-center d-flex flex-column align-items-center justify-content-center mt-3">
                                            <a href="{{ route('profile', auth()->user()) }}" class="">
                                                <img src="{{ asset('assets/avatars') }}/{{ auth()->user()->photo_profile }}"
                                                    style="width: 4rem">
                                            </a>
                                            @if (auth()->user()->hidden)
                                                <p class="text-dark mb-1">hidden</p>
                                            @else
                                                <p class="text-success mb-1">visible</p>
                                            @endif
                                            <p style="color: gray">Balance: <br>
                                                <span class="text-dark fw-bold">
                                                    <i class="fa-solid fa-coins"></i>
                                                    {{ auth()->user()->balance_format }}
                                                </span>
                                            </p>
                                        </div>
                                        @if (Route::is('profile'))
                                            <a class="dropdown-item text-center" href="{{ route('dashboard') }}">Dashboard</a>
                                        @else
                                            <a class="dropdown-item text-center"
                                                href="{{ route('profile', auth()->user()) }}">Profile</a>
                                        @endif
                                        <a class="dropdown-item text-center" href="{{ route('list_chat') }}">Chat</a>
                                    </li>
                                @endcan
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <li>
                                        <button type="submit" class="dropdown-item text-center">
                                            Log out
                                        </button>
                                    </li>
                                </form>
                            </ul>
                        </li>
                        @if (!Route::is('shop') && !Route::is('chat'))
                            <li class="nav-item position-absolute" style="right: 18rem; top: 2rem;">
                                @can('see', auth()->user())
                                    <a class="nav-link active" aria-current="page" href="{{ route('shop') }}"><i
                                            class="fa-solid fa-store fa-xl">SHOP</i></a>
                                @endcan
                            </li>
                        @endif
                    </ul>
                @endauth

                @guest
                    <li class="nav-item dropdown position-absolute fw-bold" style="right: 7rem; top:2rem">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Guest
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        </ul>
                    </li>
                @endguest
        </div>
    </div>
</nav>
