<nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarDefault"
            aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <a class="navbar-brand text-brand" href="index.html">Real<span class="color-b">Estate</span></a>

        <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
            <ul class="navbar-nav">

                <li class="nav-item">
                    <a class="nav-link active" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('about') }}">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('all.properties') }}">Property</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item " href="{{ route('all.properties') }}">Property Grid</a>
                        <a class="dropdown-item " href="">Agent Grid</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('contact') }}">Contact</a>
                </li>
                @if (Route::has('login'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
                    <div class="dropdown-menu">
                        @if(auth()->check())
                        <a class="dropdown-item " href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            Sign Out
                        </a>
                        @else
                        <a class="dropdown-item " href="{{ route('login') }}">Sign In</a>
                        @if (Route::has('register'))
                        <a class="dropdown-item " href="{{ route('register') }}">Register</a>
                        @endif
                        @endif
                    </div>
                </li>
                @endif
            </ul>
        </div>

        <button type="button" class="btn btn-b-n navbar-toggle-box navbar-toggle-box-collapse" data-bs-toggle="collapse"
            data-bs-target="#navbarTogglerDemo01">
            <i class="bi bi-search"></i>
        </button>

    </div>
</nav>