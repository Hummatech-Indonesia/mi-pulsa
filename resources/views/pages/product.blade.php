@extends('layouts.app')
@section('css')
    <style>
        .text-hover-light:hover {
            color: white !important;
            /* Menambahkan warna putih saat hover */
        }
    </style>
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
@endsection
@section('script')
@endsection
