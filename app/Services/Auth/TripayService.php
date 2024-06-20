<?php

namespace App\Services\Auth;

use App\Contracts\Interfaces\Dashboard\TopupAgenInterface;
use App\Enums\StatusTransactionEnum;
use App\Enums\TopupViaEnum;
use App\Http\Requests\RequestTransactionWhatsappRequest;
use App\Http\Requests\Tripay\RequestTransactionRequest;
use App\Models\TopupAgen;
use Illuminate\Http\Request;

class TripayService
{
    private TopupAgenInterface $topup;
    public function __construct(TopupAgenInterface $topup)
    {
        $this->topup = $topup;
    }

    public function paymentChannel()
    {
        $apiKey = env('TRIPAY_API_KEY');
        $curl = curl_init();
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_FRESH_CONNECT => true,
                CURLOPT_URL => env('TRIPAY_API_URL') . '/merchant/payment-channel',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $apiKey],
                CURLOPT_FAILONERROR => false,
                CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
            )
        );

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        $data = $response ? $response : $error;
        $response = json_decode($data);
        if ($response->success == true) {
            $data = $response->data;
            return $data;
        } else {
            return $response->message;
        }
    }


    public function requestTransaction(RequestTransactionRequest $request)
    {
        $data = $request->validated();
        $apiKey = env('TRIPAY_API_KEY');
        $privateKey = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef = 'INV' . substr(time(), -6);
        $balance = intval($data['balance']);

        $data = [
            'method' => 'BRIVA',
            'merchant_ref' => $merchantRef,
            'amount' => $balance,
            'customer_name' => auth()->user()->name,
            'customer_phone' => auth()->user()->phone_number,
            'customer_email' => auth()->user()->email,
            'order_items' => [
                [

                    'name' => 'Saldo-Rp ' . number_format($balance, 0, ',', '.'),
                    'price' => $balance,
                    'quantity' => 1,
                ],
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature' => hash_hmac('sha256', $merchantCode . $merchantRef . $balance, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => env('TRIPAY_API_URL') . '/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = json_decode(curl_error($curl));
        $responseSuccess = json_decode($response);

        return $responseSuccess ? $responseSuccess : $error;
    }


    public function requestTransactionWhatsapp(RequestTransactionWhatsappRequest $request)
    {
        $data = $request->validated();
        $apiKey = env('TRIPAY_API_KEY');
        $privateKey = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef = 'MPLS' . substr(time(), -6);
        $balance = intval($data['balance']);

        $data = [
            'method' => $data['method'],
            'merchant_ref' => $merchantRef,
            'amount' => $balance,
            'customer_name' => auth()->user()->name,
            'customer_phone' => auth()->user()->phone_number,
            'customer_email' => auth()->user()->email,
            'order_items' => [
                [
                    'name' => 'Saldo-Rp ' . number_format($balance, 0, ',', '.'),
                    'price' => $balance,
                    'quantity' => 1,
                ],
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature' => hash_hmac('sha256', $merchantCode . $merchantRef . $balance, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_URL => env('TRIPAY_API_URL') . '/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => false,
            CURLOPT_HTTPHEADER => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR => false,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = json_decode(curl_error($curl));
        $responseSuccess = json_decode($response);

        $getYear = substr(now()->format('Y'), -2);

        $count = TopupAgen::count() + 1;

        $external_id = "MPLS" . $getYear . str_pad($count, 4, '0', STR_PAD_LEFT);

        TopupAgen::create([
            'user_id' => $request->input('user_id'),
            'invoice_id' => $external_id,
            'invoice_url' => $responseSuccess->data->checkout_url,
            // 'expiry_date' => $responseSuccess->data->expired_time,
            'paid_amount' => $responseSuccess->data->amount,
            'fee_amount' => $responseSuccess->data->total_fee,
            'payment_channel' => $responseSuccess->data->payment_name,
            'payment_method' => $responseSuccess->data->payment_method,
            'amount' => $responseSuccess->data->amount_received,
            'status' => StatusTransactionEnum::UNPAID->value,
            'transaction_via' => TopupViaEnum::WHATSAPP->value,
        ]);


        return $responseSuccess ? $responseSuccess : $error;
    }

    /**
     * callback
     *
     * @param  mixed $request
     * @return void
     */
    public function callback(Request $request)
    {
        $privateKey = env('TRIPAY_API_KEY');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $privateKey);
        dd($signature);
    }

    /**
     * handleGenerateCallbackSignature
     *
     * @param  mixed $request
     * @return string
     */
    public static function handleGenerateCallbackSignature(Request $request): string
    {
        $privateKey = env('TRIPAY_PRIVATE_KEY');
        dd($privateKey);
        return hash_hmac('sha256', $request->getContent(), $privateKey);
    }
}
