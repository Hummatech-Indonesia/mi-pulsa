@php
    use App\Helpers\UserHelper;
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
                        <h4 class="fw-semibold mb-8">Tabel Admin & Agen</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Admin & Agen</li>
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
                <h5 class="card-title fw-semibold mb-0 lh-sm">Tabel Admin & Agen</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fs-4 ti ti-plus"></i>Add
                </button>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive rounded-2 mb-4">
                    <table class="table border text-nowrap customize-table mb-0 align-middle">
                        <form action="" method="GET" class="mb-3">
                            @csrf
                            <input type="text" name="search" id="search" placeholder="cari.." class="form-control">
                        </form>
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Email</h6>
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
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('dashboard_assets/dist/images/profile/user-1.jpg') }}"
                                                class="rounded-circle" width="40" height="40" />
                                            <div class="ms-3">
                                                <h6 class="fs-4 fw-semibold mb-0">{{ $user->name }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $user->email }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 fw-normal">{{ $user->phone_number }}</p>
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
                                                        class="dropdown-item d-flex align-items-center gap-3 update-user"
                                                        data-bs-toggle="modal" data-bs-target="#updateUser"
                                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                                                        data-email="{{ $user->email }}"
                                                        data-phone-number="{{ $user->phone_number }}"
                                                        data-role="{{ UserHelper::getRole($user) }}">
                                                        <i class="fs-4 ti ti-pencil"></i>Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button"
                                                        class="dropdown-item d-flex align-items-center gap-3 delete-user"
                                                        data-bs-toggle="modal" data-bs-target="#deleteUser"
                                                        data-id="{{ $user->id }}">
                                                        <i class="fs-4 ti ti-trash"></i>Delete
                                                    </button>
                                                </li>

                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                        {{ $users->links('pagination::bootstrap-5') }}
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
