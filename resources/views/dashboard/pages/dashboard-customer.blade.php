@extends('dashboard.layouts.app')
@section('css')
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem;">
                <div class="card p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-people" viewBox="0 0 16 16">
                        <path
                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                    </svg>
                    <h1 style="display: flex; justify-content:center;">{{ $customer_count }}</h1>
                    <p style="display: flex; justify-content:center;">Jumlah Pelanggan</p>
                </div>
                <div class="card p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-box" viewBox="0 0 16 16">
                        <path
                            d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z" />
                    </svg>
                    <h1 style="display: flex; justify-content:center;">{{ $transaction_count }}</h1>
                    <p style="display: flex; justify-content:center;">Jumlah Transaksi</p>
                </div>
                <div class="card p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-wallet2" viewBox="0 0 16 16">
                        <path
                            d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                    </svg>
                    <h1 style="display: flex; justify-content:center;">{{ $transaction_success_count }}</h1>
                    <p style="display: flex; justify-content:center;">Jumlah Transaksi Berhasil</p>
                </div>
                <div class="card p-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-wallet2" viewBox="0 0 16 16">
                        <path
                            d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                    </svg>
                    <h1 style="display: flex; justify-content:center;">{{ $transaction_failed_count }}</h1>
                    <p style="display: flex; justify-content:center;">Jumlah Transaksi Gagal</p>
                </div>
            </div>
            <div class="col-lg-12 d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Top 10 Customer dengan transaksi terbanyak</h5>
                            </div>
                            {{-- <div>
                                <select class="form-select">
                                    <option value="1">March 2023</option>
                                    <option value="2">April 2023</option>
                                    <option value="3">May 2023</option>
                                    <option value="4">June 2023</option>
                                </select>
                            </div> --}}
                        </div>
                        <div class="">
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
                                            <h6 class="fs-4 fw-semibold mb-0">Total Transaksi</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $index => $customer)
                                        <tr>
                                            <td>
                                                <p>{{ $index + 1 }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $customer->name }}</p>
                                            </td>
                                            <td>
                                                <p>{{ $customer->transactions->count() }}</p>
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
@endsection
