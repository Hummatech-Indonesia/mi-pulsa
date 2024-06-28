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
        <div id="alert">
        </div>
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
        <div class="card w-100 overflow-hidden">
            <div class="">
                <div class="d-flex align-items-center py-3 px-3 border-bottom justify-content-between">
                    <div class="col-12 col-md-2 text-md-end">
                        <button id="addTopupCustomer" data-bs-toggle="modal" data-bs-target="#addCustomerModal"
                            data-products="{{ $products }}" class="btn btn-primary w-100"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus" viewBox="0 0 16 16">
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                            </svg> Kirim Langsung</button>
                    </div>
                    <div class="col-12 col-md-2 text-md-end d-flex">
                        <button id="saveCheckedValues" class="btn btn-primary w-100">Top Up Semua</button>
                        <div id="loading-top-up">

                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body p-4">
                <div class="table-responsive rounded-2 mb-4">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <select name="pagination" id="showPagination" class="form-control">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="1000">Tampilkan Semua</option>
                            </select>
                        </div>
                        <div class="row gx-2 gy-2 align-items-center mb-3">
                            <div class="col-12 col-sm-8 col-md-9">
                                <input type="text" name="search" id="search" placeholder="Cari.."
                                    class="form-control">
                            </div>
                            <div class="col-12 col-sm-4 col-md-3">
                                <button id="button-search" class="btn btn-primary w-100"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-search" viewBox="0 0 16 16">
                                        <path
                                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg></button>
                            </div>
                        </div>
                    </div>
                    <table class="table border text-nowrap customize-table mb-0 align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th>
                                    <input type="checkbox" name="" class="" id="checkbox-all">
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">#</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Produk</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Nomor Telepon</h6>
                                </th>
                                <th>
                                    <h6 class="fs-4 fw-semibold mb-0">Top Up</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody id="table_content">
                        </tbody>
                    </table>
                    <div id="loading">

                    </div>
                    <div class="mt-3" id="pagination">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <x-top-up-saldo-modal></x-top-up-saldo-modal>
    <x-add-topup-customer-modal></x-add-topup-customer-modal>
    <script>
        $(document).on('click', '#addTopupCustomer', function() {
            $('#addTopupCustomerModal').modal('show');
            const products = $(this).data('products')
            $.each(products, function(index, product) {
                $('#add_product_id').append(
                    `<option value="${product.id}">${product.product_name} (${product.buyer_sku_code})</option>`
                )
            })
            let url = `{{ route('transactions.topup.customer') }}`
            $('#addTopupCustomerForm').attr('action', url)
        })
        $(document).on('click', '#topUp', function() {
            $('#topUpSaldoModal').modal('show');
            const id = $(this).data('id');
            const product_id = $(this).data('product-id');
            const products = $(this).data('product');
            const name = $(this).data('name');
            const package = $(this).data('package');
            $('#name').html(name);
            $('#package').html(package);
            $('#select_product').empty();
            $('#select_product').append(
                `<option value="">Pilih Produk Yang Dibeli</option>`
            );

            $.each(products, function(index, product) {
                if (product.id == product_id) {
                    $('#select_product').append(
                        `<option selected value="${product.buyer_sku_code}">${product.product_name}</option>`
                    );
                } else {
                    $('#select_product').append(
                        `<option value="${product.buyer_sku_code}">${product.product_name}</option>`
                    );
                }
            });
            let url = `{{ route('digi-flazz.transaction', ':id') }}`.replace(':id', id);
            $('#topUpSaldo').attr('action', url);
        });
        $(document).ready(function() {
            $('#saveCheckedValues').click(function() {
                var checkedValues = [];

                $('.check:checked').each(function() {
                    checkedValues.push($(this)
                        .val());
                });

                $.ajax({
                    url: '{{ route('digi-flazz.blazz.topup') }}',
                    type: 'POST',
                    data: {
                        checkedValues: checkedValues
                    },
                    beforeSend: function() {
                        $('#loading-top-up').html(showLoadingTopUp())
                        $('#saveCheckedValues').prop('disabled', true);
                    },
                    success: function(response) {
                        $('#loading-top-up').html('')
                        $('#saveCheckedValues').prop('disabled', false);
                        $('.check').prop('checked', false);
                        $('#checkbox-all').prop('checked', false);
                        $('#alert').html(
                            `<div class="alert alert-success alert-dismissible" role="alert">
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                <div class="alert-message">
                                    <strong>Sukses!</strong> ${response.meta.message}
                                </div>
                            </div>`
                        );
                    },
                    error: function(xhr, status, error) {
                        $('#loading-top-up').html('')
                        $('#saveCheckedValues').prop('disabled', false);
                        $('.check').prop('checked', false);
                        $('#checkbox-all').prop('checked', false);
                        let response = JSON.parse(xhr.responseText);
                        if (response.meta.code == 400) {
                            $('#alert').html(
                                `<div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <div class="alert-message">
                                        <strong>Terjadi Kesalahan!</strong> ${response.meta.message}
                                    </div>
                                </div>`
                            );
                        } else {
                            $('#alert').html(
                                `<div class="alert alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    <div class="alert-message">
                                    <strong>Terjadi Kesalahan!</strong> ${response.errors.checkedValues}
                                    </div>
                                    </div>`
                            );
                        }
                    }
                });
            });
        });
    </script>
    <script>
        get(1);
        $('#showPagination').change(function(e) {
            e.preventDefault();
            get(1)
        });
        $('#button-search').click(function(e) {
            e.preventDefault();
            get(1)
        });

        function get(page) {
            $.ajax({
                url: "{{ route('dashboard.json.customer') }}",
                type: "GET",
                data: {
                    pagination: $('#showPagination').val(),
                    name: $('#search').val(),
                    page: page
                },
                beforeSend: function() {
                    $('#table_content').html('')
                    $('#pagination').html('')
                    $('#loading').html(showLoading())
                },
                success: function(response) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('json.products') }}",
                        success: function(products) {
                            $('#loading').html('')
                            $.each(response.data.data.data, function(index, data) {
                                $('#table_content').append(kirimPulsa((page - 1) * 10 +
                                    index, data, products.data))
                            })
                            $('#pagination').html(handlePaginate(response.data.paginate))
                        }
                    });
                }
            });
        }

        function kirimPulsa(index, customer, products) {
            let options = "";
            products.forEach(product => {
                options += `<option ${product.id == customer.product_id ? 'selected' : ''} value="${product.id}">
                               ${product.product_name}
                           </option>`;
            });

            let html = `<tr>
                            <td>
                                <input type="checkbox" class="check" value="${customer.id}" name="customer_id[]" id="">
                            </td>
                            <td>
                                <p class="mb-0 fw-normal">${index + 1}</p>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="{{ asset('dashboard_assets/dist/images/profile/user-1.jpg') }}"
                                        class="rounded-circle" width="40" height="40" />
                                    <div class="ms-3">
                                        <h6 class="fs-4 fw-semibold mb-0">${customer.name}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form action="/update-product-customer/${customer.id}" method="post" style="display: flex">
                                    <input type="hidden" name="_method" value="PATCH">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <select name="product_id" class="form-control">${options}</select>
                                    <button style="margin-left: 1rem" class="btn btn-primary" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-floppy" viewBox="0 0 16 16">
                                            <path d="M11 2H9v3h2z" />
                                            <path d="M1.5 0h11.586a1.5 1.5 0 0 1 1.06.44l1.415 1.414A1.5 1.5 0 0 1 16 2.914V14.5a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13A1.5 1.5 0 0 1 1.5 0M1 1.5v13a.5.5 0 0 0 .5.5H2v-4.5A1.5 1.5 0 0 1 3.5 9h9a1.5 1.5 0 0 1 1.5 1.5V15h.5a.5.5 0 0 0 .5-.5V2.914a.5.5 0 0 0-.146-.353l-1.415-1.415A.5.5 0 0 0 13.086 1H13v4.5A1.5 1.5 0 0 1 11.5 7h-7A1.5 1.5 0 0 1 3 5.5V1H1.5a.5.5 0 0 0-.5.5m3 4a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5V1H4zM3 15h10v-4.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <p class="mb-0 fw-normal">${customer.phone_number}</p>
                            </td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#topUpSaldoModal" data-id="${customer.id}" id="topUp" class="btn btn-primary">Top up</button>
                            </td>
                        </tr>`;

            $('tbody').append(html);
            return '';
        }

        $(document).ready(function() {
            $('#checkbox-all').change(function() {
                if ($(this).prop('checked')) {
                    $('.check').prop('checked', true);
                } else {
                    $('.check').prop('checked', false);
                }
            });
            $('tbody').on('change', '.check', function() {
                if (!$(this).prop('checked')) {
                    $('#checkbox-all').prop('checked', false);
                }
            });
        });

        function handlePaginate(pagination) {
            const paginate = $('<ul>').addClass('pagination')
            const currentPage = pagination.current_page
            const lastPage = pagination.last_page
            if (lastPage >= 11) {
                var startPage = currentPage
                var endPage = currentPage + 1
                if (startPage > 1) startPage = currentPage - 1
                if (currentPage == lastPage) endPage -= 1
                for (var page = startPage; page <= endPage; page++) {
                    const pageItem = $('<li>').addClass('page-item')
                    page == currentPage ? pageItem.addClass('active') : '';
                    const pageLink =
                        `<button class="page-link" onclick="get(${page})" >${page}</button>`
                    pageItem.html(pageLink)
                    paginate.append(pageItem)
                }
                const morePage = `<li class="page-item disabled">
                            <button
                            class="page-link"
                            tabindex="-1"
                            aria-disabled="true"
                            >...</button>
                        </li>`
                if (currentPage >= 3) {
                    var leftPage = 3;
                    if (currentPage == 3) leftPage = 1
                    if (currentPage == 4) leftPage = 2
                    if (currentPage >= 6) paginate.prepend(morePage)
                    for (var page = leftPage; page >= 1; page--) {
                        const pageItem = $('<li>').addClass('page-item')
                        const pageLink =
                            `<button  class="page-link" onclick="get(${page})">${page}</button>`
                        pageItem.html(pageLink)
                        paginate.prepend(pageItem)
                    }
                }
                if (currentPage <= (lastPage - 2)) {
                    var rightPage = 1
                    if (currentPage == (lastPage - 2)) rightPage = 0
                    if (currentPage == (lastPage - 3)) rightPage = 1
                    if (currentPage < (lastPage - 4)) paginate.append(morePage)
                    for (var page = (lastPage - rightPage); page <= lastPage; page++) {
                        const pageItem = $('<li>').addClass('page-item')
                        const pageLink = `<button class="page-link" onclick="get(${page})">${page}</button>`
                        pageItem.html(pageLink)
                        paginate.append(pageItem)
                    }
                }
            } else {
                for (var page = 1; page <= lastPage; page++) {
                    const pageItem = $('<li>').addClass('page-item')
                    page == currentPage ? pageItem.addClass('active') : '';
                    const pageLink = `<button class="page-link" onclick="get(${page})">${page}</button>`
                    pageItem.append(pageLink)
                    paginate.append(pageItem)
                }
            }
            const previous = `<li class="page-item ${currentPage == 1 ? 'disabled' : ''}" ${currentPage != 1 ? 'onclick="get('+(currentPage - 1)+')"' : ''}>
                            <button
                            class="page-link"
                            tabindex="-1"
                            aria-disabled="true"
                            >Previous</button>
                        </li>`
            const next = `<li class="page-item ${currentPage == lastPage ? 'disabled' : ''}" ${currentPage != lastPage ? 'onclick="get('+(pagination.current_page + 1)+')"' : ''}>
                                <button class="page-link" href="#">Next</button>
                        </li>`
            paginate.prepend(previous)
            paginate.append(next)
            return paginate
        }

        function showLoading() {
            return `<div class="d-flex justify-content-center" style="margin-top:11rem">
                        <div class="spinner-border my-auto" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>`
        }

        function showLoadingTopUp() {
            return ` <div class="d-flex justify-content-center">
                                <div class="spinner-border my-auto" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>`
        }
    </script>
@endsection
