<?php

namespace App\Services\Auth;

use App\Http\Requests\Tripay\RequestTransactionRequest;

class TripayService
{


    public function paymentChannel()
    {
        $apiKey = "DEV-OJFjNqtkh6VZA3zeuGNSTPvTYMUQaRlPGXCYwrWN";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/merchant/payment-channel',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ));

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
        $apiKey       = env('TRIPAY_API_KEY');
        $privateKey   = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $merchantRef  = 'INV' . substr(time(), -6);
        $amount       = $data['amount'];

        $data = [
            'method'         => 'BRIVA',
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => auth()->user()->name,
            'customer_phone' => auth()->user()->phone_number,
            'customer_email' => auth()->user()->email,
            'order_items'    => [
                [

                    'name'        => 'Saldo-' + "Rp " . number_format($amount, 0, ',', '.'),
                    'price'       => $amount,
                    'quantity'    => 1,
                ],
            ],
            'expired_time' => (time() + (24 * 60 * 60)), // 24 jam
            'signature'    => hash_hmac('sha256', $merchantCode . $merchantRef . $amount, $privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => 'https://tripay.co.id/api-sandbox/transaction/create',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = json_decode(curl_error($curl));
        $responseSuccess = json_decode($response);

        return $responseSuccess ? $responseSuccess : $error;
    }
}
