@php
    use App\Helpers\FormatedHelper;
    use App\Enums\StatusDigiFlazzEnum;
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
                        <h4 class="fw-semibold mb-8">Detail Riwayat Transaksi Multiple</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted " href="index-2.html">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Detail Riwayat Transaksi Multiple</li>
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
                    <!-- Combined Form -->
                    <div class="col-12">
                        <form action="" method="GET" class="row gx-2 gy-2 align-items-center mb-0">
                            <!-- Filter Select -->
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <select name="filter" id="filter" class="form-control">
                                    <option value="">Status</option>
                                    <option value="{{ StatusDigiFlazzEnum::PENDING->value }}"
                                        {{ request()->filter == StatusDigiFlazzEnum::PENDING->value ? 'selected' : '' }}>
                                        Pending</option>
                                    <option value="{{ StatusDigiFlazzEnum::SUCCESS->value }}"
                                        {{ request()->filter == StatusDigiFlazzEnum::SUCCESS->value ? 'selected' : '' }}>
                                        Berhasil</option>
                                    <option value="{{ StatusDigiFlazzEnum::FAILED->value }}"
                                        {{ request()->filter == StatusDigiFlazzEnum::FAILED->value ? 'selected' : '' }}>
                                        Gagal</option>
                                </select>
                            </div>
                            <!-- Search Input -->
                            <div class="col-12 col-md-3 mb-3 mb-md-0">
                                <input type="text" name="name" id="search" placeholder="cari.."
                                    class="form-control" value="{{ request()->name }}">
                            </div>
                            <!-- Start Date -->
                            <div class="col-12 col-md-2 mb-3 mb-md-0">
                                <input type="date" name="start_date" id="start_date" class="form-control">
                            </div>
                            <!-- End Date -->
                            <div class="col-12 col-md-2 mb-3 mb-md-0">
                                <input type="date" name="end_date" id="end_date" class="form-control">
                            </div>
                            <!-- Submit Button -->
                            <div class="col-12 col-md-2">
                                <button class="btn btn-primary w-100">Terapkan</button>
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
                                    <h6 class="fs-4 fw-semibold mb-0">Status</h6>
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
                                        @if ($transaction->price != null)
                                            <h6>{{ FormatedHelper::rupiahCurrency($transaction->price) }}</h6>
                                        @else
                                            <h6>0</h6>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($transaction->status == StatusDigiFlazzEnum::SUCCESS->value)
                                            <h6><span class="badge text-bg-success">{{ $transaction->status }}</span></h6>
                                        @elseif ($transaction->status == StatusDigiFlazzEnum::PENDING->value)
                                            <h6><span class="badge text-bg-warning">{{ $transaction->status }}</span></h6>
                                        @else
                                            <h6><span class="badge text-bg-danger">{{ $transaction->status }}</span></h6>
                                        @endif
                                    </td>
                                    <td>
                                        <h6>{{ FormatedHelper::dateTimeFormat($transaction->created_at) }}</h6>
                                    </td>
                                    <td>
                                        <button data-bs-toggle="modal" id="button_message" data-bs-target="#messageModal"
                                            data-message="{{ $transaction->message }}" class="btn btn-primary"><svg
                                                xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                                                <path
                                                    d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z" />
                                            </svg></button>
                                    </td>
                                    <td>
                                        @if ($transaction->status == StatusDigiFlazzEnum::FAILED->value)
                                            <button data-bs-toggle="modal" id="repeatTopUp"
                                                data-bs-target="#repeatTopUpModal"
                                                data-name="{{ $transaction->customer->name }}"
                                                data-url="{{ route('digi-flazz.repeat.transaction', $transaction->id) }}"
                                                data-package="{{ $transaction->product->product_name }}"
                                                class="btn btn-primary">Top
                                                Up
                                                Ulang</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">

                        {{ $transactions->appends(['filter'=>request('filter'),'search' => request('search'), 'start_date' => request('start_date'), 'end_date' => request('end_date')])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <x-top-up-saldo-modal></x-top-up-saldo-modal>
    <x-repeat-top-up-saldo-modal></x-repeat-top-up-saldo-modal>
    <x-message-modal></x-message-modal>
    <script>
        $(document).on('click', '#button_message', function() {
            const message = $(this).data('message');
            $('#message').html(message);
        });

        $(document).on('click', '#repeatTopUp', function() {
            const name = $(this).data('name');
            const package = $(this).data('package');
            const url = $(this).data('url');
            $('#name_user').html(name);
            $('#package').html(package);
            $('#repeatTopUpSaldo').attr('action', url);
        });
    </script>
@endsection
