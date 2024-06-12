@extends('dashboard.layouts.app')

@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <x-alert-success></x-alert-success>
        @elseif(session('error'))
            <x-alert-failed></x-alert-failed>
        @endif

        <form action="{{ route('tripay.request.transaction') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="card p-3">
                        <div class="d-flex gap-3 align-items-center mb-3">
                            <div class="bg-primary rounded-circle p-3"></div>
                            <span class="fw-bold">Pilih Pulsa</span>
                        </div>
                        <div class="col">
                            <input type="text" name="balance" id="balanceInput" class="form-control balance-input"
                                placeholder="Ketik Nominal">
                            <span class="fw-light fs-2">Minimal Rp. 50.000</span>
                        </div>
                        <div class="col-12 my-2">
                            <div class="d-flex mx-auto flex-wrap btn-group" role="group" aria-label="Pilihan Pulsa">
                                @for ($i = 1; $i <= 20; $i++)
                                    <div class="col-lg-3 col-md-4 col-sm-6 my-2">
                                        <input type="radio" class="btn-check balance-radio" name="balance"
                                            id="balanceRadio-{{ $i }}" value="{{ $i * 50000 }}">
                                        <label class="btn btn-outline-primary" for="balanceRadio-{{ $i }}">Rp.
                                            {{ number_format($i * 50000) }}</label>
                                    </div>
                                @endfor
                            </div>
                        </div>
                        <div class="d-flex gap-3 align-items-center mb-3">
                            <div class="bg-primary rounded-circle p-3"></div>
                            <span class="fw-bold">Metode Pembayaran</span>
                        </div>
                        <div class="accordion" id="paymentAccordion">
                            @foreach (['Virtual Account', 'Convenience Store', 'E-Wallet'] as $group)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading{{ str_replace(' ', '', $group) }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapsePaymentChannel{{ str_replace(' ', '', $group) }}"
                                            aria-expanded="false"
                                            aria-controls="collapsePaymentChannel{{ str_replace(' ', '', $group) }}">
                                            {{ $group }}
                                        </button>
                                    </h2>
                                    <div id="collapsePaymentChannel{{ str_replace(' ', '', $group) }}"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ str_replace(' ', '', $group) }}"
                                        data-bs-parent="#paymentAccordion">
                                        <div class="accordion-body">
                                            <div class="row col-12">
                                                @foreach ($paymentChannels as $paymentChannel)
                                                    @if ($paymentChannel->group == $group)
                                                        <div class="col-6 mb-3">
                                                            <div
                                                                class="card p-3 d-flex flex-row align-items-center justify-content-between">
                                                                <input type="radio" name="method"
                                                                    id="payment_channel_{{ $paymentChannel->code }}"
                                                                    class="form-check-input me-2"
                                                                    value="{{ $paymentChannel->code }}"
                                                                    data-fee="{{ $paymentChannel->total_fee->flat }}"
                                                                    data-name="{{ $paymentChannel->name }}">
                                                                <label for="payment_channel_{{ $paymentChannel->code }}"
                                                                    class="form-check-label d-flex align-items-center justify-content-between w-100">
                                                                    <span>{{ $paymentChannel->name }}</span>
                                                                    <img src="{{ $paymentChannel->icon_url }}"
                                                                        alt="{{ $paymentChannel->name }} icon"
                                                                        class="img-fluid ms-2"
                                                                        style="max-width: 64px; height: auto;">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Rincian Pesanan
                        </div>
                        <div class="card-body">
                            <div class="justify-content-between d-flex">
                                <label class="form-label">Metode Pembayaran</label>
                                <p id="payment-method">-</p>
                            </div>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.1)">
                            <div class="justify-content-between d-flex">
                                <label class="form-label">Harga Pesanan</label>
                                <p id="price-order">Rp. -</p>
                            </div>
                            <div class="justify-content-between d-flex">
                                <label class="form-label">Biaya Layanan</label>
                                <p id="fee">Rp. -</p>
                            </div>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.1)">
                            <div class="justify-content-between d-flex">
                                <label class="form-label fw-bold">Total Pesanan</label>
                                <p id="total-order">Rp. -</p>
                            </div>
                            <div class="card-footer p-0">
                                <button class="btn btn-warning w-100" type="submit">Buat Pesanan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function updateOrderDetails() {
                const selectedBalance = $('.balance-radio:checked').val() || $('.balance-input').val();
                const selectedMethod = $('input[name="method"]:checked');
                const methodName = selectedMethod.data('name') || '-';
                const fee = selectedMethod.data('fee') || 0;

                $('#payment-method').text(methodName);
                $('#price-order').text('Rp. ' + Number(selectedBalance).toLocaleString());
                $('#fee').text('Rp. ' + Number(fee).toLocaleString());
                $('#total-order').text('Rp. ' + (Number(selectedBalance) + Number(fee)).toLocaleString());
            }

            $('.balance-input, .balance-radio, input[name="method"]').on('change', updateOrderDetails);
            $('.balance-input').on('input', function() {
                $('.balance-radio').prop('checked', false);
                updateOrderDetails();
            });
            $('.balance-radio').on('change', function() {
                $('.balance-input').val('');
                updateOrderDetails();
            });

        });
    </script>
@endsection
