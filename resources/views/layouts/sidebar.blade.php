<style>
    .nav-link.active {
    color: #ffffff !important; /* Warna teks */
    font-weight: bold; /* Teks tebal */
}

</style>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
  <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
         <div class="sidebar-brand-icon">
            <!-- Ganti dengan gambar logo -->
            <img src="{{ asset('foto/Logo.jpg') }}" width="40" height="40">
        </div>
        <div class="sidebar-brand-text mx-3">SIMARA</div>
    </a>

  
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  
  <!-- Nav Item - Home -->
  <ul class="nav">
    <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span>
    </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('rapat') ? 'active' : '' }}" href="{{ route('rapat') }}">
            <i class="fas fa-fw fa-calendar-alt"></i>
            <span>Notulen</span>
        </a>
    </li>

    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('berita') ? 'active' : '' }}" href="{{ route('berita') }}">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>Cetak Notulen</span>
        </a>
    </li>

    </li>
    <li class="nav-item">
    <a class="nav-link {{ request()->is('profile') ? 'active' : '' }}" href="/profile">
        <i class="fas fa-fw fa-user"></i>
        <span>Profile</span>
    </a>

    </li>
     <li class="nav-item">
    <a class="nav-link {{ request()->is('logout') ? 'active' : '' }}" href="{{ route('logout') }}">
        <i class="fas fa-fw fa-user"></i>
        <span>Logout</span>
    </a>

    </li>
    
    
  </ul>
  
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-lock">
  
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>