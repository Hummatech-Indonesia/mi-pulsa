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
                        <h4 class="fw-semibold mb-8">Provider</h4>
                        <p>List provider yang ada pada website anda.</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProvider">
                            Tambah Provider
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 position-relative overflow-hidden">
                        <form action="" method="GET" class="d-flex mb-0 col-3">
                            <input type="text" name="name" id="search" placeholder="cari.."
                                class="form-control me-2" value="{{ request()->name }}">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                        <div class="card-body p-4">
                            <div class="table-responsive rounded-2 mb-4">
                                <table class="table border text-nowrap customize-table mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">No. </h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Aksi</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($providers as $index => $provider)
                                            <tr>
                                                <td>
                                                    <h6 class="fs-4 fw-semibold mb-0">{{ $index + 1 }}</h6>
                                                </td>
                                                <td>
                                                    <h6 class="fs-4 fw-semibold mb-0">{{ $provider->name }}</h6>
                                                </td>
                                                <td>
                                                    <ul class="d-flex " aria-labelledby="dropdownMenuButton">
                                                        <li>
                                                            <button type="button"
                                                                class=" btn d-flex align-items-center gap-3 update-user"
                                                                data-bs-toggle="modal" data-bs-target="#updateUser"
                                                                data-id="{{ $provider->id }}"
                                                                data-name="{{ $provider->name }}">
                                                                <i class="fs-4 ti ti-pencil"></i>Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button"
                                                                class=" btn d-flex align-items-center gap-3 delete-user"
                                                                data-bs-toggle="modal" data-bs-target="#deleteUser"
                                                                data-id="{{ $provider->id }}">
                                                                <i class="fs-4 ti ti-trash"></i>Delete
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
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <x-delete-modal></x-delete-modal>
        <x-update-provider-modal></x-update-user-modal>
            <x-add-provider-modal></x-add-provider-modal>

            <script>
                $(document).on('click', '.update-user', function() {
                    $('#updateUserModal').modal('show')
                    const name = $(this).attr('data-name');
                    const id = $(this).attr('data-id');
                    $('#name').val(name);
                    let url = `{{ route('dashboard.providers.update', ':id') }}`.replace(':id', id);
                    $('#updateUserForm').attr('action', url);
                });
                $(document).on('click', '.delete-user', function() {
                    $('#deleteModal').modal('show')
                    const id = $(this).attr('data-id');
                    let url = `{{ route('dashboard.providers.destroy', ':id') }}`.replace(':id', id);
                    $('#deleteForm').attr('action', url);
                });
            </script>
        @endsection
