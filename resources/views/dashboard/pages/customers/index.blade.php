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
            <div class="d-flex px-4 py-3 border-bottom justify-content-between align-items-center">
                <h5 class="card-title fw-semibold mb-0 lh-sm">Tabel Pengguna</h5>
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
                                    <h6 class="fs-4 fw-semibold mb-0">Provider</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Nomor Telepon</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($customers as $customer)
                                <tr>
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
                                        <p class="mb-0 fw-normal">{{ $customer->provider }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $customer->phone_number }}</p>
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
                                                        class="dropdown-item d-flex align-items-center gap-3 edit-customer"
                                                        data-bs-toggle="modal" data-bs-target="#updateCustomer"
                                                        data-id="{{ $customer->id }}" data-name="{{ $customer->name }}"
                                                        data-provider="{{ $customer->provider }}"
                                                        data-phone-number="{{ $customer->phone_number }}">
                                                        <i class="fs-4 ti ti-pencil"></i>Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button"
                                                        class="dropdown-item d-flex align-items-center gap-3 delete-customer"
                                                        data-bs-toggle="modal" data-bs-target="#deleteCustomer"
                                                        data-id="{{ $customer->id }}">
                                                        <i class="fs-4 ti ti-trash"></i>Delete
                                                    </button>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        {{ $customers->links('pagination::bootstrap-5') }}
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
    <x-edit-customer-modal></x-edit-customer-modal>
    <x-add-customer-modal></x-add-customer-modal>
    <script>
        $(document).on('click', '.edit-customer', function() {
            $('#editCustomerModal').modal('show')
            const id = $(this).data('id');
            const name = $(this).data('name');
            const provider = $(this).data('provider');
            const phone_number = $(this).data('phone-number');
            $('#name').val(name);
            $('#provider').val(provider);
            $('#phone_number').val(phone_number);
            let url = `{{ route('customers.update', ':id') }}`.replace(':id', id);
            $('#editCustomerForm').attr('action', url);
        });
        $(document).on('click', '.delete-customer', function() {
            $('#deleteModal').modal('show')
            const id = $(this).attr('data-id');
            let url = `{{ route('customers.destroy', ':id') }}`.replace(':id', id);
            $('#deleteForm').attr('action', url);
        });
    </script>
@endsection
