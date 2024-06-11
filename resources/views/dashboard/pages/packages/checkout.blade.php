@extends('dashboard.layouts.app')
@section('content')
    <style>
        .ul {
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
                            <span class="text-dark">Paket </span>
                            <div class="">
                                <span class="fs-2">Rp. 1.550.000</span>
                                <span class="text-primary">Rp. 850.000</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-dark">Diskon</span>
                            <div class="">
                                <span class="text-primary">Rp. -</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center py-3">
                            <span class="text-dark">Total Pembayaran</span>
                            <div class="">
                                <span class="text-primary">{{ $service->data->amount }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-dark">Kode Transaksi</span>
                            <div class="">
                                <span class="text-primary">{{ $service->data->reference }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">
                            <span class="text-dark">Bayar sebelum tanggal</span>
                            <div class="">
                                <?php
                                use Carbon\Carbon;
                                
                                // Set locale to Indonesian
                                Carbon::setLocale('id');
                                
                                // Get the timestamp and format it
                                $expiredTime = $service->data->expired_time;
                                $formattedDateTime = Carbon::createFromTimestamp($expiredTime)->translatedFormat('j F Y');
                                ?>



                                <span class="text-primary">{{ $formattedDateTime }}</span>
                            </div>
                        </div>
                        <div class="grid col-12">

                            <div class="col-12">
                                <p class="text-dark border-bottom py-3">{{ $service->data->payment_name }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="">
                                        <p class="text-dark">Kode Pembayaran</p>
                                        <p class="text-primary">{{ $service->data->pay_code }}</p>
                                    </div>
                                    <button class="btn btn-primary">Salin</button>
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
                            @foreach ($service->data->instructions as $index => $instruction)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ $index }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $index }}" aria-expanded="false"
                                            aria-controls="collapse{{ $index }}">
                                            {{ $instruction->title }}
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $index }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $index }}" data-bs-parent="#paymentInstructions">
                                        <div class="accordion-body">
                                            <ul class="border-bottom p-3">
                                                @foreach ($instruction->steps as $step)
                                                    <li>{!! $step !!}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <a href="{{ $service->data->checkout_url }}"
                        class="btn bg-primary-subtle text-primary btn-light text-center text-primary mt-3">OK</a>
                </div>
            </div>
        </div>

    </div>
@endsection
