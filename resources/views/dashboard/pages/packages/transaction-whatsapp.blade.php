@extends('dashboard.layouts.app')
@section('content')
    <div class="container-fluid">
        <form action="{{ route('transactions.whatsapp.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-7">
                    <div class="card p-3">
                        <div class="d-flex gap-3 align-items-center mb-3">
                            <div class="bg-primary rounded-circle p-3"></div>
                            <span class="fw-bold">Pilih Pulsa</span>
                        </div>
                        <div class="col">
                            <input type="text" name="balance" id="balanceInput" class="form-control" width="50px" placeholder="Ketik Nominal">
                            <span class="fw-light fs-2">Minimal Rp. 50.000</span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="" class="form-label">Agen</label>
                            <select name="user_id" id="" class="form-control">
                                <option value="">Pilih Agen</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex gap-3 align-items-center mb-3">
                            <div class="bg-primary rounded-circle p-3"></div>
                            <span class="fw-bold">Metode Pembayaran</span>
                        </div>


                        <div class="accordion" id="paymentAccordion">
                            <!-- Virtual Account Collapse -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingVA">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentChannelVA" aria-expanded="false" aria-controls="collapsePaymentChannelVA">
                                        Virtual Account
                                    </button>
                                </h2>
                                <div id="collapsePaymentChannelVA" class="accordion-collapse collapse" aria-labelledby="headingVA" data-bs-parent="#paymentAccordion">
                                    <div class="accordion-body">
                                        <div class="row col-12">
                                            @foreach ($paymentChannels as $paymentChannel)
                                                @if ($paymentChannel->group == 'Virtual Account')
                                                    <div class="col-6 mb-3">
                                                        <div class="card p-3 d-flex flex-row align-items-center justify-content-between">
                                                            <input type="radio" name="method" id="payment_channel_{{ $paymentChannel->code }}" class="form-check-input me-2" value="{{ $paymentChannel->code }}" data-fee="{{ $paymentChannel->total_fee->flat }}" data-name="{{ $paymentChannel->name }}">
                                                            <label for="payment_channel_{{ $paymentChannel->code }}" class="form-check-label d-flex align-items-center justify-content-between w-100">
                                                                <span>{{ $paymentChannel->name }}</span>
                                                                <img src="{{ $paymentChannel->icon_url }}" alt="{{ $paymentChannel->name }} icon" class="img-fluid ms-2" style="max-width: 64px; height: auto;">
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Convenience Store Collapse -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingCS">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentChannelCS" aria-expanded="false" aria-controls="collapsePaymentChannelCS">
                                        Convenience Store
                                    </button>
                                </h2>
                                <div id="collapsePaymentChannelCS" class="accordion-collapse collapse" aria-labelledby="headingCS" data-bs-parent="#paymentAccordion">
                                    <div class="accordion-body">
                                        <div class="row col-12">
                                            @foreach ($paymentChannels as $paymentChannel)
                                                @if ($paymentChannel->group == 'Convenience Store')
                                                    <div class="col-6 mb-3">
                                                        <div class="card p-3 d-flex flex-row align-items-center justify-content-between">
                                                            <input type="radio" name="method" id="payment_channel_{{ $paymentChannel->code }}" class="form-check-input me-2" value="{{ $paymentChannel->code }}" data-fee="{{ $paymentChannel->total_fee->flat }}" data-name="{{ $paymentChannel->name }}">
                                                            <label for="payment_channel_{{ $paymentChannel->code }}" class="form-check-label d-flex align-items-center justify-content-between w-100">
                                                                <span>{{ $paymentChannel->name }}</span>
                                                                <img src="{{ $paymentChannel->icon_url }}" alt="{{ $paymentChannel->name }} icon" class="img-fluid ms-2" style="max-width: 64px; height: auto;">
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- E-Wallet Collapse -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingEW">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentChannelEW" aria-expanded="false" aria-controls="collapsePaymentChannelEW">
                                        E-Wallet
                                    </button>
                                </h2>
                                <div id="collapsePaymentChannelEW" class="accordion-collapse collapse" aria-labelledby="headingEW" data-bs-parent="#paymentAccordion">
                                    <div class="accordion-body">
                                        <div class="row col-12">
                                            @foreach ($paymentChannels as $paymentChannel)
                                                @if ($paymentChannel->group == 'E-Wallet')
                                                    <div class="col-6 mb-3">
                                                        <div class="card p-3 d-flex flex-row align-items-center justify-content-between">
                                                            <input type="radio" name="method" id="payment_channel_{{ $paymentChannel->code }}" class="form-check-input me-2" value="{{ $paymentChannel->code }}" data-fee="{{ $paymentChannel->total_fee->flat }}" data-name="{{ $paymentChannel->name }}">
                                                            <label for="payment_channel_{{ $paymentChannel->code }}" class="form-check-label d-flex align-items-center justify-content-between w-100">
                                                                <span>{{ $paymentChannel->name }}</span>
                                                                <img src="{{ $paymentChannel->icon_url }}" alt="{{ $paymentChannel->name }} icon" class="img-fluid ms-2" style="max-width: 64px; height: auto;">
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-header align-items-center bg-primary text-white">
                            Rincian Pesanan
                        </div>
                        <div class="card-body">
                            <div class="justify-content-between d-flex">
                                <label for="" class="form-label">Metode Pembayaran</label>
                                <p id="payment-method">-</p>
                            </div>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.1)">
                            <div class="justify-content-between d-flex">
                                <label for="" class="form-label">Harga Pesanan</label>
                                <p id="price-order">Rp. -</p>
                            </div>
                            <hr style="border-top: 1px solid rgba(0, 0, 0, 0.1)">
                            <div class="justify-content-between d-flex">
                                <label for="" class="form-label fw-bold">Total Pesanan</label>
                                <p id="total-order">Rp. -</p>
                            </div>
                            <div class="card-footer p-0">
                                <button class="btn btn-warning align-items-center w-100" type="submit">Buat Pesanan</button>
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
            $('input[name="balance"], input[name="method"]').on('change', function() {
                const selectedBalance = $('input[name="balance"]:checked').val() || $('#balanceInput').val();
                const selectedMethod = $('input[name="method"]:checked');
                const methodName = selectedMethod.data('name') || '-';
                const fee = selectedMethod.data('fee') || 0;

                $('#payment-method').text(methodName);
                $('#price-order').text('Rp. ' + Number(selectedBalance).toLocaleString());
                $('#total-order').text('Rp. ' + Number(selectedBalance).toLocaleString());
                $('#fee').text('Rp. ' + Number(fee).toLocaleString());
            });

            $('#balanceInput').on('input', function() {
                $('input[name="balance"]').prop('checked', false).trigger('change');
            });
        });
    </script>
@endsection
