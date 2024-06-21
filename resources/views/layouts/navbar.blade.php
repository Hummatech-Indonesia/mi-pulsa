@php
    use App\Helpers\UserHelper;
@endphp
<nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0 sticky-top ">
    <a href="{{ route('home.index') }}" class="navbar-brand p-0">
        <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>MiPulsa</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('home.index') }}"
                class="nav-item nav-link {{request()->routeIs('home.index') ? 'active' : ''}} ">Beranda</a>
            <a href="{{ route('home.product') }}"
                class="nav-item nav-link {{request()->routeIs('home.product') ? 'active' : ''}} ">Daftar Harga</a>
            <a href="{{ route('home.about') }}"
                class="nav-item nav-link {{request()->routeIs('home.about') ? 'active' : ''}} ">Tentang Kami</a>
            <a href="{{ route('home.contact') }}" class="nav-item nav-link {{request()->routeIs('home.contact') ? 'active' : ''}}">Hubungi Kami</a>
        </div>
        <button type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal">
            <i class="fa fa-search"></i>
        </button>
        @auth
            <div class="dropdown">
                <button class="dropdown-toggle btn btn-primary py-2 px-4 ms-3" type="button" data-bs-toggle="dropdown">
                    {{ UserHelper::getUserName() }}
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ route('dashboard.index') }}" class="dropdown-item">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary py-2 px-4 ms-3">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary py-2 px-4 ms-3">Daftar</a>
        @endauth
    </div>
</nav>
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
            <div class="modal-header border-0">
                <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-center">
                <div class="input-group" style="max-width: 600px;">
                    <input type="text" class="form-control bg-transparent border-primary p-3"
                        placeholder="Type search keyword">
                    <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
