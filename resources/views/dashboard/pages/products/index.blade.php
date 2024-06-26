@php
    use App\Helpers\FormatedHelper;
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 position-relative overflow-hidden">
                        <form action="" method="GET" class="d-flex mb-0 col-3">
                            <input type="text" name="search" id="search" placeholder="cari.."
                                class="form-control me-2" value="{{ request()->search }}">
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </form>
                        <div class="card-body p-4">
                            <div class="table-responsive rounded-2 mb-4">
                                <table class="table border text-nowrap customize-table mb-0 align-middle">
                                    <thead class="text-dark fs-4">
                                        <tr>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Kode Produk</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Operator</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Harga Beli</h6>
                                            </th>
                                            <th>
                                                <h6 class="fs-4 fw-semibold mb-0">Harga Jual</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>
                                                    <h6 class="fs-4 fw-semibold mb-0">{{ $product->product_name }}</h6>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">{{ $product->buyer_sku_code }}</p>
                                                </td>
                                                <td>
                                                    <p class="mb-0 fw-normal">{{ $product->brand }}</p>
                                                </td>
                                                <td>
                                                    @if ($product->price <= $product->selling_price)
                                                        <span
                                                            class="badge rounded-pill text-bg-primary">{{ FormatedHelper::rupiahCurrency($product->price) }}</span>
                                                    @else
                                                        <span
                                                            class="badge rounded-pill text-bg-danger">{{ FormatedHelper::rupiahCurrency($product->price) }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form action="{{ route('product.selling.price', $product->id) }}"
                                                        class="d-flex" method="post">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="number" name="selling_price" class="form-control"
                                                            value="{{ $product->selling_price }}" id="">
                                                        <button class="btn btn-primary" style="margin-left: 3rem;"
                                                            type="submit">Simpan</button>
                                                    </form>
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

        <!-- --------------------------------------------------- -->
        <!--  Form Basic End -->
        <!-- --------------------------------------------------- -->
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            function calculateMD5Hash(username, developmentKey) {
                var message = username + developmentKey + 'depo';
                return CryptoJS.MD5(message).toString();
            }

            function postDataToAPI() {
                var username = '{{ env('DIGIFLAZZ_USERNAME') }}';
                var developmentKey = '{{ env('DIGIFLAZZ_DEVELOPMENT_KEY') }}';

                var hash = calculateMD5Hash(username, developmentKey);

                var postData = {
                    "cmd": "deposit",
                    "username": username,
                    "sign": hash
                };

                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: '/digi-flazz/price-list',
                    type: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: JSON.stringify(postData),
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            function formatRupiah(angka) {
                var reverse = angka.toString().split('').reverse().join(''),
                    ribuan = reverse.match(/\d{1,3}/g);
                ribuan = ribuan.join('.').split('').reverse().join('');
                return ribuan;
            }

            postDataToAPI();
        });
    </script>
@endsection
