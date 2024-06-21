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
        <div id="alert">
        </div>
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
        <div class="card w-100 overflow-hidden">
            <div class="">
                <div class="d-flex align-items-center py-3 px-3 border-bottom justify-content-between">
                    <div class="col-12 col-md-4 mb-3 mb-md-0">
                        <form action="" method="GET" class="row gx-2 gy-2 align-items-center mb-0">
                            @csrf
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" name="search" id="search" placeholder="Cari.."
                                    class="form-control">
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <button class="btn btn-primary w-100">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-2 text-md-end">
                        <button data-bs-toggle="modal" data-bs-target="#addCustomerModal" data-product="{{ $products }}"
                            class="btn btn-primary w-100"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                            </svg> Kirim Langsung</button>
                    </div>
                    <div class="col-12 col-md-2 text-md-end">
                        <button id="saveCheckedValues" class="btn btn-primary w-100">Top Up Semua</button>
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
                                        <input type="checkbox" class="check" value="{{ $customer->id }}"
                                            name="customer_id[]" id="">
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
                                        <form action="{{ route('update.product.customer', $customer->id) }}" method="post"
                                            style="display: flex">
                                            @csrf
                                            @method('PATCH')
                                            <select name="product_id" class="form-control" id="">
                                                @foreach ($products as $product)
                                                    <option {{ $product->id == $customer->product_id ? 'selected' : '' }}
                                                        value="{{ $product->id }}">
                                                        {{ $product->product_name }}</option>
                                                @endforeach
                                            </select>
                                            <button style="margin-left: 1rem" class="btn btn-primary" type="submit"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                                    <path d="M11 2H9v3h2z" />
                                                    <path
                                                        d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                                                </svg></button>
                                        </form>
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
    <x-add-topup-customer-modal></x-add-topup-customer-modal>
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

        $(document).ready(function() {
            $('#saveCheckedValues').click(function() {
                var checkedValues = [];

                $('.check:checked').each(function() {
                    checkedValues.push($(this)
                        .val());
                });

                $.ajax({
                    url: '{{ route('digi-flazz.blazz.topup') }}',
                    type: 'POST',
                    data: {
                        checkedValues: checkedValues
                    },
                    success: function(response) {
                        $('#alert').html(
                            `<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="alert-message">
                                    <strong>Sukses!</strong> ${response.meta.message}
                                </div>
                            </div>`
                        );
                    },
                    error: function(xhr, status, error) {
                        let response = JSON.parse(xhr.responseText);
                        $('#alert').html(
                            `<div class="alert alert-danger alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="alert-message">
                                    <strong>Terjadi Kesalahan!</strong> ${response.errors.checkedValues}
                                </div>
                            </div>`
                        );
                    }
                });
            });
        });
    </script>
@endsection
