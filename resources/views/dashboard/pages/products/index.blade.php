@extends('dashboard.layouts.app')
@section('content')
    <div class="container-fluid">
        <!-- --------------------------------------------------- -->
        <!--  Form Basic Start -->
        <!-- --------------------------------------------------- -->
        <div class="card bg-light-info shadow-none position-relative overflow-hidden">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Tabel Produk</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Produk</li>
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
            <div class="d-flex px-4 py-3 border-bottom justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0 lh-sm">Tabel Produk</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
                    <i class="fs-4 ti ti-plus"></i>Add
                </button>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive rounded-2 mb-4">
                    <table class="table border text-nowrap customize-table mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Harga</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Deskripsi</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $product->logo ? asset('storage/' . $product->logo) : asset('dashboard_assets/dist/images/profile/user-1.jpg') }}"
                                                alt="photo" class="img-fluid rounded-circle mb-2"
                                                style="object-fit: cover;" width="64" height="64">
                                            <div class="ms-3">
                                                <h6 class="fs-4 fw-semibold mb-0">{{ $product->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $product->price }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $product->description }}</p>
                                    </td>

                                    <td>
                                        <div class="dropdown dropstart">
                                            <a href="#" class="text-muted" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-dots-vertical fs-6"></i>
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                <li>
                                                    <button type="button"
                                                        class="dropdown-item d-flex align-items-center gap-3 edit-product"
                                                        data-bs-toggle="modal" data-bs-target="#editCustomer"
                                                        data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                                                        data-price="{{ $product->price }}"
                                                        data-description="{{ $product->description }}"
                                                        data-logo="{{ $product->logo }}">
                                                        <i class="fs-4 ti ti-pencil"></i>Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button"
                                                        class="dropdown-item d-flex align-items-center gap-3 delete-product"
                                                        data-bs-toggle="modal" data-bs-target="#deleteCustomer"
                                                        data-id="{{ $product->id }}">
                                                        <i class="fs-4 ti ti-trash"></i>Delete
                                                    </button>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- --------------------------------------------------- -->
        <!--  Form Basic End -->
        <!-- --------------------------------------------------- -->
    </div>
@endsection
@section('script')
    <x-delete-modal></x-delete-modal>
    <x-edit-product-modal></x-edit-product-modal>
    <x-add-product-modal></x-add-product-modal>
    <script>
        $(document).on('click', '.edit-product', function() {
            $('#editProductModal').modal('show');

            const id = $(this).data('id');
            const name = $(this).data('name');
            const description = $(this).data('description');
            const price = $(this).data('price');
            const logo = $(this).data('logo');

            $('#name').val(name);
            $('#description').val(description);
            $('#price').val(price);
            // $('#logo').val(logo);

            var logoImage = `{{ asset('storage') }}/${logo}`;
            $('#logoImage').attr('src', logoImage);

            let url = `{{ route('products.update', ':id') }}`.replace(':id', id);
            $('#editProductForm').attr('action', url);
        });

        $(document).on('click', '.delete-product', function() {
            $('#deleteModal').modal('show')
            const id = $(this).attr('data-id');
            let url = `{{ route('products.destroy', ':id') }}`.replace(':id', id);
            $('#deleteForm').attr('action', url);
        });
    </script>
@endsection
