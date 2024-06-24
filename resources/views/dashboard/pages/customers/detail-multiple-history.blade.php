@php
    use App\Helpers\FormatedHelper;
@endphp
@extends('dashboard.layouts.app')
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <x-alert-success></x-alert-success>
        @elseif ($errors->any())
            <x-validation-errors :errors="$errors"></x-validation-errors>
        @elseif(session('error'))
            <x-alert-failed></x-alert-failed>
        @endif
        <!-- --------------------------------------------------- -->
        <!--  Form Basic Start -->
        <!-- --------------------------------------------------- -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Tabel Pengguna</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Pengguna</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <img src="../../dist/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card w-100 position-relative overflow-hidden">
            <div class="container">
                <div class="row align-items-center py-3 border-bottom">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <form action="" method="GET" class="row gx-2 gy-2 align-items-center mb-0">
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text"name="name" id="search" placeholder="cari.." class="form-control"
                                    value="{{ request()->name }}">
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <button class="btn btn-primary w-100">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive rounded-2 mb-4">
                    <table class="table border text-nowrap customize-table mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">#</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Nama Customer</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Produk</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Harga</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Tanggal Transaksi</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $index => $transaction)
                                <tr>
                                    <td>
                                        <h6>{{ $index + 1 }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $transaction->customer->name }}</h6>
                                    </td>
                                    <td>
                                        <h6>{{ $transaction->product->product_name }}</h6>
                                    </td>
                                    <td>
                                        @if ($transaction->price != 0)
                                            <h6>{{ FormatedHelper::rupiahCurrency($transaction->price) }}</h6>
                                        @else
                                            <h6>0</h6>
                                        @endif
                                    </td>
                                    <td>
                                        <h6>{{ FormatedHelper::dateTimeFormat($transaction->created_at) }}</h6>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">

                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <x-top-up-saldo-modal></x-top-up-saldo-modal>
    <script>
        $(document).on('click', '#topUp', function() {
            $('#topUpSaldoModal').modal('show');
            const id = $(this).data('id');
            const product_id = $(this).data('product-id');
            const products = $(this).data('product');
            const name = $(this).data('name');
            const package = $(this).data('package');
            $('#name').html(name);
            $('#package').html(package);
            $('#select_product').empty();
            $('#select_product').append(
                `<option value="">Pilih Produk Yang Dibeli</option>`
            );
            $.each(products, function(index, product) {
                if (product.id == product_id) {
                    $('#select_product').append(
                        `<option selected value="${product.buyer_sku_code}">${product.product_name}</option>`
                    );
                } else {
                    $('#select_product').append(
                        `<option value="${product.buyer_sku_code}">${product.product_name}</option>`
                    );
                }
            });

            let url = `{{ route('digi-flazz.transaction', ':id') }}`.replace(':id', id);
            $('#topUpSaldo').attr('action', url);
        });

        $(document).ready(function() {
            $('#checkbox-all').change(function() {
                if ($(this).prop('checked')) {
                    $('.check').prop('checked', true);
                } else {
                    $('.check').prop('checked', false);
                }
            });

            $('.check').change(function() {
                if (!$(this).prop('checked')) {
                    $('#checkbox-all').prop('checked', false);
                }
            });
        });
    </script>
@endsection
