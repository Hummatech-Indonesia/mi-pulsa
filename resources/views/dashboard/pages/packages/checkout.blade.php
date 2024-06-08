@extends('dashboard.layouts.app')
@section('content')
    <style>
        ul {
            list-style: auto !important;
        }
    </style>
    <div class="container-fluid">

        <div class="card p-3 bg-primary">
            <div class="d-flex justify-content-between align-items-center">
                <div class="">
                    <h1 class="fw-bold text-white title">Menunggu Pembayaran</h1>
                    <h3 class="fw-bold text-white">Segera Bayar Pesanan Anda!</h3>
                </div>
                <div class="">
                    <img src="{{ asset('assets/img/about.jpg') }}" alt="" class="img-fluid" width="125">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-7">
                <div class="card">
                    <div class="card-header text-center bg-primary">
                        <h5 class="fw-bold text-white align-items-center">Rincian Pembayaran</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-dark">Paket E-Learning (3 Bulan)</span>
                            <div class="">
                                <span class="fs-2">Rp. 1.550.000</span>
                                <span class="text-primary">Rp. 850.000</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-dark">Diskon</span>
                            <div class="">
                                <span class="text-primary">Rp. 300.000</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span class="text-dark">Total Pembayaran</span>
                            <div class="">
                                <span class="text-primary">Rp. 550.000</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-dark">Kode Transaksi</span>
                            <div class="">
                                <span class="text-primary">DEV-123456789ABC</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-dark">Bayar sebelum tanggal</span>
                            <div class="">
                                <span class="text-primary">13 Oktober 2023</span>
                            </div>
                        </div>
                        <div class="grid col-12">
                            <div class="row">
                                <div class="col-2 d-flex align-items-start">
                                    <img src="https://assets.tripay.co.id/upload/payment-icon/ytBKvaleGy1605201833.png"
                                        alt="" class="img-fluid card p-2 mt-3" width="72" height="72">
                                </div>
                                <div class="col-10">
                                    <p class="text-dark border-bottom py-3">Bank BCA</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="">
                                            <p class="text-dark">Kode Pembayaran</p>
                                            <p class="text-primary">ABCDEFGHIJKL123</p>
                                        </div>
                                        <button class="btn btn-primary">Salin</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-5">
                <div class="card">
                    <div class="card-header text-center bg-primary">
                        <h3 class="text-white">Instruksi Pembayaran</h3>
                    </div>
                    <div class="card-body mb-3">
                        <div class="accordion" id="paymentInstructions">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingInternetBanking">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseInternetBanking" aria-expanded="true" aria-controls="collapseInternetBanking">
                                        Internet Banking
                                    </button>
                                </h2>
                                <div id="collapseInternetBanking" class="accordion-collapse collapse show" aria-labelledby="headingInternetBanking" data-bs-parent="#paymentInstructions">
                                    <div class="accordion-body">
                                        <ul class="border-bottom p-3">
                                            <li>Login ke Internet banking bank anda</li>
                                            <li>Masukkan informasi pembayaran</li>
                                            <li>Konfirmasi transaksi</li>
                                            <li>Simpan bukti pembayaran</li>
                                            <li>Verifikasi pembayaran di aplikasi kami</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingATM">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseATM" aria-expanded="false" aria-controls="collapseATM">
                                        ATM (nama bank)
                                    </button>
                                </h2>
                                <div id="collapseATM" class="accordion-collapse collapse" aria-labelledby="headingATM" data-bs-parent="#paymentInstructions">
                                    <div class="accordion-body">
                                        <ul class="border-bottom p-3">
                                            <li>Masukkan kartu ATM dan PIN</li>
                                            <li>Pilih menu pembayaran</li>
                                            <li>Masukkan kode pembayaran</li>
                                            <li>Konfirmasi transaksi</li>
                                            <li>Simpan struk pembayaran</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn bg-primary-subtle text-primary btn-light text-center text-primary mt-3">OK</button>
                </div>
            </div>
        </div>

    </div>
@endsection
