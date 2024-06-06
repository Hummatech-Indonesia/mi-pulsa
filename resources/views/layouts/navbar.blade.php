@php
    use App\Helpers\UserHelper;
@endphp

<nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
    <a href="{{ route('home.index') }}" class="navbar-brand p-0">
        <h1 class="m-0"><i class="fa fa-user-tie me-2"></i>MiPulsa</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="fa fa-bars"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{ route('home.index') }}" class="nav-item nav-link active">Beranda</a>
            <a href="about.html" class="nav-item nav-link">Daftar Harga</a>
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Blog</a>
                <div class="dropdown-menu m-0">
                    <a href="blog.html" class="dropdown-item">Blog Grid</a>
                    <a href="detail.html" class="dropdown-item">Blog Detail</a>
                </div>
            </div> --}}
            <a href="contact.html" class="nav-item nav-link">Tentang Kami</a>
            <a href="contact.html" class="nav-item nav-link">Hubungi Kami</a>
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
