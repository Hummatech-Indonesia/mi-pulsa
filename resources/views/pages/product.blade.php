@extends('layouts.app')
@section('css')
    <style>
        .text-hover-light:hover {
            color: white !important;
            /* Menambahkan warna putih saat hover */
        }
    </style>
@endsection
@section('content')
<div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
    <div class="container py-5">
            <div class="section-title position-relative pb-3 mb-5">
                <h5 class="fw-bold text-primary text-uppercase">Daftar Harga</h5>
            </div>
            <form action="{{ route('digi-flazz.get.price.list') }}" method="get">
                @csrf
                <div class="d-flex">
                    <input type="text" name="search" id="search" class="form-control rounded mb-3"
                        placeholder="cari produk..">
                </div>
            </form>
            <div class="row">
                <div class="col-md-4">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-pills flex-column w-100 mb-3" id="pills-tab" role="tablist">
                        <!-- Tabs will be generated dynamically -->
                    </ul>
                </div>
                <!-- Tab Content -->
                <div class="col-md-8">
                    <div class="tab-content" id="pills-tabContent">
                        <!-- Tab content will be generated dynamically -->
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            function loadPriceList() {
                $.ajax({
                    url: "{{ route('digi-flazz.get.price.list') }}",
                    type: "GET",
                    success: function(response) {
                        // Mengasumsikan response mengembalikan data dalam format array of objects
                        var groupedProducts = groupByBrand(response.data);
                        updateTabs(groupedProducts);
                    },
                    error: function() {
                        alert('Gagal memuat daftar harga');
                    }
                });
            }

            function groupByBrand(products) {
                return products.reduce(function(acc, product) {
                    (acc[product.brand] = acc[product.brand] || []).push(product);
                    return acc;
                }, {});
            }

            function updateTabs(groupedProducts) {
                var tabList = $('#pills-tab');
                var tabContent = $('#pills-tabContent');
                tabList.empty();
                tabContent.empty();
                var isFirst = true;
                for (var brand in groupedProducts) {
                    var tabId = brand.toLowerCase().replace(/\s+/g, '-');
                    tabList.append(
                        '<li class="nav-item" role="presentation">' +
                        '<button class="nav-link w-100' + (isFirst ? ' active' : '') + '" id="' + tabId +
                        '-tab" data-bs-toggle="pill" data-bs-target="#' + tabId +
                        '" type="button" role="tab" aria-controls="' + tabId + '" aria-selected="' + (isFirst ?
                            'true' : 'false') + '">' + brand + '</button>' +
                        '</li>'
                    );
                    var productsHtml = groupedProducts[brand].map(function(product) {
                        return '<tr><td>' + product.product_name + '</td><td>Rp.' + (product.selling_price)
                            .toLocaleString() +
                            '</td></tr>';
                    }).join('');
                    tabContent.append(
                        '<div class="tab-pane fade' + (isFirst ? ' show active' : '') + '" id="' + tabId +
                        '" role="tabpanel" aria-labelledby="' + tabId + '-tab">' +
                        '<table class="table table-striped">' +
                        '<thead><tr><th>Produk</th><th>Harga</th></tr></thead>' +
                        '<tbody>' + productsHtml + '</tbody>' +
                        '</table>' +
                        '</div>'
                    );
                    isFirst = false;
                }
            }

            loadPriceList();
        });
    </script>
@endsection
