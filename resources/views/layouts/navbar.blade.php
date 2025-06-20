<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    @guest
        <!-- Belum Login -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
            <img src="{{ asset('foto/Logo.jpg') }}" width="40" height="40">
            <div class="sidebar-brand-text mx-3">SIMARA</div>
        </a>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link" href="{{ route('login') }}">
                    MASUK
                </a>
            </li>
        </ul>
    @endguest

    @auth
        <!-- Sudah Login -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>

        <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Sudah Login -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                        {{ auth()->user()->name }}
                        <br>
                        <small>{{ auth()->user()->level }}</small>
                    </span>

                    
                </a>
                
            </li>
        </ul>
    @endauth
</nav>
