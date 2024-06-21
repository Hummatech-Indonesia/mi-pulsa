@extends('layouts.app')
@section('carousel')
    @include('layouts.carousel')
@endsection
@section('content')
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <input type="text" name="search" id="search" class="form-control rounded mb-3" placeholder="cari produk..">
            <div class="row">
                <div class="col-md-4">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-pills flex-column w-100 mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link w-100 active" id="telkomsel-tab" data-bs-toggle="pill"
                                data-bs-target="#telkomsel" type="button" role="tab" aria-controls="telkomsel"
                                aria-selected="true">Telkomsel</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link w-100" id="indosat-tab" data-bs-toggle="pill" data-bs-target="#indosat"
                                type="button" role="tab" aria-controls="indosat" aria-selected="false">Indosat</button>
                        </li>
                    </ul>
                </div>
                <!-- Tab Content -->
                <div class="col-md-8">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="telkomsel" role="tabpanel"
                            aria-labelledby="telkomsel-tab">
                            <div class="bg-primary p-2">
                                <h5 class="fw-bold text-white d-flex align-items-center mb-0 mt-0">Telkomsel</h5>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 5; $i++)
                                        <tr>
                                            <td>Telkomsel {{ number_format(10000 + $i * 5000) }}</td>
                                            <td>Rp.{{ number_format(10000 + $i * 5000 + $i * 2000) }}</td>
                                        </tr>
                                    @endfor
                                    <tr>
                                        <td colspan="2">
                                            <a href="" class="btn btn-outline-primary d-flex justify-content-center">
                                                <span class="text-hover-light">Lihat Selengkapnya</span>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="indosat" role="tabpanel" aria-labelledby="indosat-tab">
                            <div class="bg-primary p-2">
                                <h5 class="fw-bold text-white d-flex align-items-center mb-0 mt-0">Indosat</h5>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < 5; $i++)
                                        <tr>
                                            <td>Indosat {{ number_format(10000 + $i * 5000) }}</td>
                                            <td>Rp.{{ number_format(10000 + $i * 5000 + $i * 2000) }}</td>
                                        </tr>
                                    @endfor
                                    <tr>
                                        <td colspan="2">
                                            <a href=""
                                                class="btn btn-outline-primary d-flex justify-content-center">
                                                <span class="text-hover-light">Lihat Selengkapnya</span>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Service Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Layanan Kami</h5>
                <h1 class="mb-0">Solusi Topup Pulsa dan Paket Data untuk Anda</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.3s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-mobile-alt text-white"></i>
                        </div>
                        <h4 class="mb-3">Topup Pulsa</h4>
                        <p class="m-0">Isi ulang pulsa semua operator dengan cepat dan mudah.</p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.6s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-wifi text-white"></i>
                        </div>
                        <h4 class="mb-3">Paket Data</h4>
                        <p class="m-0">Beli paket data semua operator tanpa ribet, langsung aktif!</p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.9s">
                    <div
                        class="service-item bg-light rounded d-flex flex-column align-items-center justify-content-center text-center">
                        <div class="service-icon">
                            <i class="fa fa-comments-dollar text-white"></i>
                        </div>
                        <h4 class="mb-3">Pulsa Transfer</h4>
                        <p class="m-0">Transfer pulsa ke sesama pengguna dengan mudah dan cepat.</p>
                        <a class="btn btn-lg btn-primary rounded" href="">
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Features Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-5 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Mengapa Memilih Kami</h5>
                <h1 class="mb-0">Kami Ada untuk Memudahkan Kebutuhan Pulsa dan Data Anda</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.2s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-thumbs-up text-white"></i>
                            </div>
                            <h4>Proses Cepat</h4>
                            <p class="mb-0">Topup dan pembelian paket data diproses dalam hitungan detik.</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.6s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-users text-white"></i>
                            </div>
                            <h4>Layanan Pelanggan</h4>
                            <p class="mb-0">Tim support kami siap membantu Anda 24/7.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4  wow zoomIn" data-wow-delay="0.9s" style="min-height: 350px;">
                    <div
                        class="position-relative bg-primary rounded h-100 d-flex flex-column align-items-center justify-content-center text-center p-5">
                        <h3 class="text-white mb-3">Call Us For Quote</h3>
                        <p class="text-white mb-3">Clita ipsum magna kasd rebum at ipsum amet dolor justo dolor est
                            magna stet eirmod</p>
                        <h2 class="text-white mb-0">+012 345 6789</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-5">
                        <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-shield-alt text-white"></i>
                            </div>
                            <h4>Keamanan Terjamin</h4>
                            <p class="mb-0">Transaksi Anda dijamin aman dengan teknologi terkini.</p>
                        </div>
                        <div class="col-12 wow zoomIn" data-wow-delay="0.4s">
                            <div class="bg-primary rounded d-flex align-items-center justify-content-center mb-3"
                                style="width: 60px; height: 60px;">
                                <i class="fa fa-shield-alt text-white"></i>
                            </div>
                            <h4>Keamanan Terjamin</h4>
                            <p class="mb-0">Transaksi Anda dijamin aman dengan teknologi terkini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->
@endsection
