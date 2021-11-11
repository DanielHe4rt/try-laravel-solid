<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="border-radius: 0px;">
    <div class="container">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('landing') }}">
                        Home
                    </a>
                </li>
                @auth()
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                @endauth
            </ul>
            @auth()
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link">Hey, {{ auth()->user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                    </li>
                </ul>
            @endauth
            @guest()
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a type="button"  data-bs-toggle="modal" data-bs-target="#signInModal" class="nav-link">Sign In</a>
                </li>
            </ul>
            @endguest

        </div>
    </div>
</nav>
