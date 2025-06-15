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
                    <!-- Menampilkan foto profil yang disimpan di storage -->
                    <img class="img-profile rounded-circle"
                        src="{{ asset('storage/profile_pictures/' . auth()->user()->id . '/profile_picture.jpg') }}"
                        alt="User Profile" width="30" height="30">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="/profile">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
    @endauth
</nav>
