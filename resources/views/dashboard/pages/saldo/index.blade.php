@extends('dashboard.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="alert alert-warning" role="alert">
            <strong>Pemberitahuan</strong>
            <p>Nomor Rekening Digiflazz :</p>
            <ul>
                <li>BCA : 6042888890</li>
                <li>Mandiri : 1550009910111</li>
                <li>BRI : 213501000291307</li>
                <li>BNI : 1996888992</li>
            </ul>
            <p class="py-0 my-0">Minimal Deposit Rp. 200.000</p>
            <p class="py-0 my-0">Nominal yang ditransfer, disesuaikan dengan response yang didapatkan nanti.</p>
            <p class="py-0 my-0">Notes dimasukkan ketika melakukan transfer.</p>
        </div>

        <!-- <div class="" id="alert_success">

        </div> -->
        @if (session('error'))
            <x-alert-failed />
        @endif
        @if (session('success'))
            <x-alert-success />
        @endif

        <form id="deposit" action="{{ route('digi-flazz.deposit') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-3">
                        <div class="d-flex gap-3 align-items-center mb-3">
                            <span class="fw-bold">Pilih Nominal</span>
                        </div>
                        <div class="col">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="text" name="amount" id="amount" class="form-control balance-input"
                                placeholder="Ketik Nominal">
                              </div>
                            <span class="fw-light fs-2">Minimal Rp. 200.000</span>
                        </div>
                        <div class="d-flex gap-3 align-items-center mb-3" style="margin-top: 1rem;">
                            <span class="fw-bold">Pilih Bank Tujuan</span>
                        </div>
                        <div class="col">
                            <select name="bank" id="bank" class="form-control balance-input"
                                placeholder="Bank Tujuan">
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                                <option value="BNI">BNI</option>
                                <option value="MANDIRI">MANDIRI</option>
                            </select>
                        </div>
                        <div class="col mt-4">
                            <button id="kirim" type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    @include('widgets.currency-format')
    <script>

        $('#amount').on('input', function(){
            let amount = $(this).val();
            let formattedValue = formatCurrency(amount);

            // Set nilai input ke nilai yang sudah diformat
            $(this).val(formattedValue);
        });

        $('#kirim').click(function(e) {
            let amount = $('#amount').val().replace(/,/g, '');
            $('#amount').val(amount);

            $('#deposit').submit();
        })
    </script>
@endsection
