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
                    <div>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <div class="w-100 position-relative overflow-hidden">
                                    <div class="card-body p-4">
                                        <div class="table-responsive rounded-2 mb-4">
                                            <table class="table border text-nowrap customize-table mb-0 align-middle">
                                                <thead class="text-dark fs-4">
                                                    <tr>
                                                        <th>
                                                            <h6 class="fs-4 fw-semibold mb-0">Nama</h6>
                                                        </th>
                                                        <th>
                                                            <h6 class="fs-4 fw-semibold mb-0">Harga</h6>
                                                        </th>
                                                        <th>
                                                            <h6 class="fs-4 fw-semibold mb-0">Operator</h6>
                                                        </th>
                                                        <th>
                                                            <h6 class="fs-4 fw-semibold mb-0">Harga</h6>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tableContent">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
    <x-delete-modal></x-delete-modal>
    <x-edit-product-modal></x-edit-product-modal>
    <x-add-product-modal></x-add-product-modal>
    <script>
        CKEDITOR.replace('.ckeditor', {
            filebrowserUploadUrl: "{{ route('upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form'
        });
        $(document).on('click', '.edit-product', function() {
            $('#editProductModal').modal('show');

            const id = $(this).data('id');
            const name = $(this).data('name');
            const description = $(this).data('description');
            const price = $(this).data('price');
            const logo = $(this).data('logo');

            $('#name').val(name);
            $('#description').val(description);
            $('#price').val(price);
            // $('#logo').val(logo);

            var logoImage = `{{ asset('storage') }}/${logo}`;
            $('#logoImage').attr('src', logoImage);

            let url = `{{ route('products.update', ':id') }}`.replace(':id', id);
            $('#editProductForm').attr('action', url);
        });

        $(document).on('click', '.delete-product', function() {
            $('#deleteModal').modal('show')
            const id = $(this).attr('data-id');
            let url = `{{ route('products.destroy', ':id') }}`.replace(':id', id);
            $('#deleteForm').attr('action', url);
        });
    </script>

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
                    url: 'digi-flazz/price-list',
                    type: 'POST',
                    contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    data: JSON.stringify(postData),
                    success: function(response) {
                        $.each(response.data, function(index, value) {
                            $('#tableContent').append(
                                `<tr>
                                <td>
                                    <h6 class="fs-4 fw-semibold mb-0">${value.product_name}</h6>
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal">
                                        ${value.category}
                                    </p>
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal">${value.brand}</p>
                                </td>
                                <td>
                                    <p class="mb-0 fw-normal">Rp. ${formatRupiah(value.price)}</p>
                                </td>
                            </tr>`
                            );
                        });
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
