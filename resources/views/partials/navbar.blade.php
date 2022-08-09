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
                <form class="d-flex ms-4" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                @auth
                    <li class="nav-item dropdown position-absolute fw-bold" style="right: 6rem">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu py-0">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn w-100">Log out</button>
                            </form>
                        </ul>
                    </li>
                @endauth

                @guest
                    <li class="nav-item dropdown position-absolute fw-bold" style="right: 6rem">
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
