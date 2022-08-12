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
                                                <p class="text-dark mb-1">{{ __('hidden') }}</p>
                                            @else
                                                <p class="text-success mb-1">{{ __('visible') }}</p>
                                            @endif
                                            <p style="color: gray">{{ __('Balance') }}: <br>
                                                <span class="text-dark fw-bold">
                                                    <i class="fa-solid fa-coins"></i>
                                                    {{ auth()->user()->balance_format }}
                                                </span>
                                            </p>
                                        </div>
                                        @if (Route::is('profile'))
                                            <a class="dropdown-item text-center"
                                                href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                                        @else
                                            <a class="dropdown-item text-center"
                                                href="{{ route('profile', auth()->user()) }}">{{ __('Profile') }}</a>
                                        @endif
                                        <a class="dropdown-item text-center"
                                            href="{{ route('list_chat') }}">{{ __('Chat') }}</a>
                                    </li>
                                @endcan
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <li>
                                        <button type="submit" class="dropdown-item text-center">
                                            {{ __('Log out') }}
                                        </button>
                                    </li>
                                </form>
                            </ul>
                        </li>
                        @if (!Route::is('shop') && !Route::is('chat'))
                            <li class="nav-item position-absolute" style="right: 18rem; top: 2rem;">
                                @can('see', auth()->user())
                                    <a class="nav-link active" aria-current="page" href="{{ route('shop') }}"><i
                                            class="fa-solid fa-store fa-xl">{{ __('SHOP') }}</i></a>
                                @endcan
                            </li>
                        @endif
                    </ul>
                @endauth
                @guest
                    <li class="nav-item dropdown position-absolute fw-bold" style="right: 7rem; top:2rem">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ __('Guest') }}
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                            <li><a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                        </ul>
                    </li>
                @endguest
                {{-- LOCALE --}}
                <li class="nav-item dropdown" style="margin-left: 2rem">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @if (App::isLocale('en'))
                            <img src="{{ asset('assets/locale/en.png') }}" class="" style="width: 2rem">
                        @else
                            <img src="{{ asset('assets/locale/id.png') }}" class="" style="width: 2rem">
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#">
                                @if (App::isLocale('en'))
                                    <form action="{{ route('change_lang', 'id') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn border-0">
                                            <img src="{{ asset('assets/locale/id.png') }}" class=""
                                                style="width: 2rem">
                                            <h5 class="d-inline fw-bold">Indonesia</h5>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('change_lang', 'en') }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn border-0">
                                            <img src="{{ asset('assets/locale/en.png') }}" class=""
                                                style="width: 2rem">
                                            <h5 class="d-inline fw-bold">English</h5>
                                        </button>
                                    </form>
                                @endif
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
