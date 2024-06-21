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
                            @csrf
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" name="search" id="search" placeholder="cari.."
                                    class="form-control">
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
                                    <input type="checkbox" name="" class="" id="checkbox-all">
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">#</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Produk</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Nomor Telepon</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Top Up</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="check" name="" id="">
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $loop->iteration }}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('dashboard_assets/dist/images/profile/user-1.jpg') }}"
                                                class="rounded-circle" width="40" height="40" />
                                            <div class="ms-3">
                                                <h6 class="fs-4 fw-semibold mb-0">{{ $customer->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $customer->product->product_name }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $customer->phone_number }}</p>
                                    </td>
                                    <td>
                                        <button data-bs-toggle="modal" data-bs-target="#topUpSaldoModal"
                                            data-name="{{ $customer->name }}" data-product="{{ $products }}"
                                            data-package="{{ $customer->product->product_name }}"
                                            data-product-id="{{ $customer->product_id }}" type="button"
                                            data-id="{{ $customer->id }}" id="topUp" class="btn btn-primary">Top
                                            up</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{ $customers->links('pagination::bootstrap-5') }}
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
