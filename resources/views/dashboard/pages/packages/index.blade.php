@extends('dashboard.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7">
                <div class="card p-3">
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div class="bg-primary rounded-circle p-3"></div>
                        <span class="fw-bold">Pilih Pulsa</span>
                    </div>
                    <div class="col">
                        <input type="text" name="" id="" class="form-control" width="50px"
                            placeholder="Ketik Nominal">
                        <span class="fw-light fs-2">Minimal Rp. 50.000</span>
                    </div>
                    <div class="col-12 my-2">
                        <div class="d-flex mx-auto flex-wrap btn-group" role="group" aria-label="Pilihan Pulsa">
                            @for ($i = 1; $i <= 20; $i++)
                                <div class="col-lg-3 col-md-4 col-sm-6 my-2" >
                                    <input type="radio" class="btn-check" name="price" id="primary-outlined-{{ $i }}"
                                        autocomplete="false" value="{{ $i * 50000 }}"

                                        >
                                    <label class="btn btn-outline-primary" for="primary-outlined-{{ $i }}">Rp. {{ number_format($i * 50000) }}</label>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <div class="bg-primary rounded-circle p-3"></div>
                        <span class="fw-bold">Metode Pembayaran</span>
                    </div>
                    <select name="payment_method" id="" class="form-control">
                        <option value="">Gopay</option>
                        <option value="">Ovo</option>
                        <option value="">Dana</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header align-items-center bg-primary text-white">
                        Rincian Pesanan
                    </div>
                    <div class="card-body">
                        <div class="justify-content-between d-flex">
                            <label for="" class="form-label">Metode Pembayaran</label>
                            <p>Gopay</p>
                        </div>
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.1)">
                        <div class="justify-content-between d-flex">
                            <label for="" class="form-label">Harga Pesanan</label>
                            <p>Rp. 10.000.000</p>
                        </div>
                        <div class="justify-content-between d-flex">
                            <label for="" class="form-label">Biaya Layanan</label>
                            <p>Rp. 10.000</p>
                        </div>
                        <hr style="border-top: 1px solid rgba(0, 0, 0, 0.1)">
                        <div class="justify-content-between d-flex">
                            <label for="" class="form-label fw-bold">Total Pesanan</label>
                            <p>Rp. 10.010.000</p>
                        </div>
                        <div class="card-footer p-0">
                            <button class="btn btn-warning align-items-center w-100">Buat Pesanan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
