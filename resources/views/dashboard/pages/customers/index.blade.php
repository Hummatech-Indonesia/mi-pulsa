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
                        <h4 class="fw-semibold mb-8">Tabel Pelanggan</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Pelanggan</li>
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
                    <div class="col-12 col-md-7 mb-3 mb-md-0">
                        <form action="" method="GET" class="row gx-2 gy-2 align-items-center mb-0">
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" name="search" id="search" placeholder="cari.."
                                    class="form-control">
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <button class="btn btn-primary w-100">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-6 col-md-3 text-md-end mb-3 mb-md-0">
                        <button type="button" class="btn btn-add btn-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#addCustomerModal" data-product="{{ $products }}">
                            <i class="fs-4 ti ti-plus"></i> Tambah Pengguna
                        </button>
                    </div>
                    <div class="col-6 col-md-2 text-md-end">
                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                            data-bs-target="#importCustomerModal">
                            <i class="fs-4 ti ti-plus"></i> Import
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive rounded-2 mb-4">
                    <table class="table border text-nowrap customize-table mb-0 align-middle">
                        <thead class="text-dar   fs-4">
                            <tr>
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
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $customer)
                                <tr>
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
                                        <ul class="d-flex" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <button type="button"
                                                    class="btn d-flex align-items-center gap-3 edit-customer"
                                                    data-bs-toggle="modal" data-bs-target="#updateCustomer"
                                                    data-id="{{ $customer->id }}" data-name="{{ $customer->name }}"
                                                    data-product-id="{{ $customer->product_id }}"
                                                    data-products="{{ $products }}"
                                                    data-phone-number="{{ $customer->phone_number }}">
                                                    <i class="fs-4 ti ti-pencil"></i>Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button"
                                                    class="btn d-flex align-items-center gap-3 delete-customer"
                                                    data-bs-toggle="modal" data-bs-target="#deleteCustomer"
                                                    data-id="{{ $customer->id }}">
                                                    <i class="fs-4 ti ti-trash"></i>Delete
                                                </button>
                                            </li>

                                        </ul>
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
    <x-import-customer-modal></x-import-customer-modal>
    <x-delete-modal></x-delete-modal>
    <x-edit-customer-modal></x-edit-customer-modal>
    <x-add-customer-modal></x-add-customer-modal>
    <script>
        $(document).on('click', '.edit-customer', function() {
            $('#editCustomerModal').modal('show');
            const id = $(this).data('id');
            const name = $(this).data('name');
            const phone_number = $(this).data('phone-number');
            const product_id = $(this).data('product-id');
            const products = $(this).data('products'); // Pastikan ini mengambil data produk yang benar

            $('#name').val(name);
            $('#phone_number').val(phone_number);

            // $('#product_id').empty(); // Bersihkan opsi sebelumnya
            $('#product_id').append(`<option value="">Pilih Produk</option>`);
            $.each(products, function(index, product) {
                let isSelected = product.id == product_id ? 'selected' : '';
                $('#product_id').append(
                    `<option value="${product.id}" ${isSelected}>${product.product_name} (${product.buyer_sku_code})</option>`
                );
            });

            let url = `{{ route('customers.update', ':id') }}`.replace(':id', id);
            $('#editCustomerForm').attr('action', url);
        });
        $(document).on('click', '.btn-add', function() {
            let products = JSON.parse($(this).attr('data-product'));


            $('#add_product_id').empty();
            $('#add_product_id').append(
                `<option value="">Pilih Produk</option>`
            );
            $.each(products, function(index, product) {
                $('#add_product_id').append(
                    `<option value="${product.id}">${product.product_name} (${product.buyer_sku_code})</option>`
                );
            });
        });


        $(document).on('click', '.delete-customer', function() {
            $('#deleteModal').modal('show')
            const id = $(this).attr('data-id');
            let url = `{{ route('customers.destroy', ':id') }}`.replace(':id', id);
            $('#deleteForm').attr('action', url);
        });
    </script>
@endsection
