@php
    use App\Helpers\UserHelper;
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
                        <h4 class="fw-semibold mb-8">Tabel Agen</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Tabel Agen</li>
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
                        <form action="" method="GET" class="row gx-2 gy-2 align-items-center mb-0">
                            @csrf
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" name="search" id="search" placeholder="cari.."
                                    class="form-control" value="{{ request()->search }}">
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <button class="btn btn-primary w-100">Cari</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-12 col-md-3 text-md-end">
                        <button type="button" class="btn btn-primary w-100 w-md-auto add-user" data-bs-toggle="modal"
                            data-bs-target="#addUserModal">
                            <i class="fs-4 ti ti-plus"></i>Tambah Agen
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
                                        <ul class="d-flex " aria-labelledby="dropdownMenuButton">

                                            <li>
                                                <button type="button"
                                                    class=" btn d-flex align-items-center gap-3 update-user"
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
                                                    class=" btn d-flex align-items-center gap-3 delete-user"
                                                    data-bs-toggle="modal" data-bs-target="#deleteUser"
                                                    data-id="{{ $user->id }}">
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
                        {{ $users->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                    </div>
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
        $(document).on('click', '.add-user', function() {
            $('#addProvider').modal('show')
            let url = `{{ route('users.store.agen') }}`;
            $('#addUserForm').attr('action', url);
        });
    </script>
@endsection
