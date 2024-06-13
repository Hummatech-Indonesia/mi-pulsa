@php
    use App\Helpers\UserHelper;
    use App\Enums\TopupViaEnum;

@endphp
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
                        <h4 class="fw-semibold mb-8">Tabel Riwayat Transaksi</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Riwayat Transaksi</li>
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
                    <div class="col-12 col-md-9 mb-3 mb-md-0">
                        <form action="" class="row gx-2 gy-2 align-items-center">
                            @csrf
                            <div class="col-12 col-sm-6 col-md-3">
                                <input type="text" name="search" id="search" placeholder="cari.." value="{{ request()->search }}" class="form-control">
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <select name="filter" id="filter" class="form-control">
                                    <option value="">Filter via transaksi</option>
                                    <option value="{{ TopupViaEnum::WHATSAPP->value }}" {{ request()->filter == TopupViaEnum::WHATSAPP->value ? 'selected' : '' }}>
                                        WHATSAPP
                                    </option>
                                    <option value="{{ TopupViaEnum::TRIPAY->value }}" {{ request()->filter == TopupViaEnum::TRIPAY->value ? 'selected' : '' }}>
                                        TRIPAY
                                    </option>
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <select name="user_id" id="" class="form-control">
                                    <option value="">Filter pengguna</option>
                                    @foreach ($topups as $topup)
                                        <option value="{{ $topup->user->id }}">{{ $topup->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3">
                                <button class="btn btn-primary w-100">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-3 text-md-end">
                        <button type="button" class="btn btn-primary w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <i class="fs-4 ti ti-plus"></i> Tambah data
                        </button>
                    </div>
                </div>
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
                                    <h6 class="fs-4 fw-semibold mb-0">Email</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Invoice Id</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Pembayaran</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Metode Pembayaran</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Transaksi Via</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                                </th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($topups as $topup)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('dashboard_assets/dist/images/profile/user-1.jpg') }}"
                                                class="rounded-circle" width="40" height="40" />
                                            <div class="ms-3">
                                                <h6 class="fs-4 fw-semibold mb-0">{{ $topup->user->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $topup->user->email }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $topup->invoice_id }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">Rp. {{ number_format($topup->amount, 0, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $topup->payment_method }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $topup->transaction_via }}</p>
                                    </td>

                                    <td>
                                        <ul class="d-flex gap-1" aria-labelledby="dropdownMenuButton">

                                            <li>
                                                <button type="button"
                                                    class="btn d-flex align-items-center gap-3 update-user"
                                                    data-bs-toggle="modal" data-bs-target="#updateUser">
                                                    <i class="fs-4 ti ti-eye"></i>Detail
                                                </button>
                                            </li>

                                        </ul>
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
    <x-update-user-modal></x-update-user-modal>
    <x-add-user-modal></x-add-user-modal>
    <script>
        $(document).on('click', '.update-user', function() {
            $('#updateUserModal').modal('show')
            const id = $(this).attr('data-id');
            const name = $(this).attr('data-name');
            const email = $(this).attr('data-email');
            const phone_number = $(this).data('phone-number');
            const role = $(this).data('role');
            console.log(role);
            $('#name').val(name);
            $('#email').val(email);
            $('#phone_number').val(phone_number);
            $('#role').val(role);
            let url = `{{ route('users.update', ':id') }}`.replace(':id', id);
            $('#updateUserForm').attr('action', url);
        });
        $(document).on('click', '.delete-user', function() {
            $('#deleteModal').modal('show')
            const id = $(this).attr('data-id');
            let url = `{{ route('users.destroy', ':id') }}`.replace(':id', id);
            $('#deleteForm').attr('action', url);
        });
    </script>
@endsection
