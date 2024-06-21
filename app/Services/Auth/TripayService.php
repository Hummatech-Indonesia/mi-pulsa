<?php

namespace App\Services\Auth;

use App\Contracts\Interfaces\Dashboard\TopupAgenInterface;
use App\Enums\StatusTransactionEnum;
use App\Enums\TopupViaEnum;
use App\Helpers\ResponseHelper;
use Carbon\Carbon;
use App\Http\Requests\Tripay\RequestTransactionRequest;
use App\Models\TopupAgen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

        $data = $responseSuccess->data;
        
        TopupAgen::create([
            'user_id' => auth()->user()->id,
            'invoice_id' => $data->reference,
            'fee_amount' => $data->total_fee,
            'invoice_url' => $data->checkout_url,
            'expiry_date' => Carbon::parse($responseSuccess->data->expired_time)->format('Y-m-d'),
            'amount' => $balance,
            'pay_code' => $data->pay_code,
            'paid_amount' => $data->amount,
            'payment_channel' => $data->payment_name,
            'payment_method' => $data->payment_method,
            'status' => StatusTransactionEnum::UNPAID->value,
            'transaction_via' => TopupViaEnum::TRIPAY->value
        ]);

        return $responseSuccess ? $responseSuccess : $error;
    }


    public function callback(Request $request)
    {
        $privateKey = "fh5Nm-awLil-GXCuC-v5juf-0T4Lm";

        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE');
        $json = $request->getContent();
        $signature = hash_hmac('sha256', $json, $privateKey);

        if ($signature !== (string) $callbackSignature) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid signature',
            ]);
        }

        if ('payment_status' !== (string) $request->server('HTTP_X_CALLBACK_EVENT')) {
            return Response::json([
                'success' => false,
                'message' => 'Unrecognized callback event, no action was taken',
            ]);
        }

        $data = json_decode($json);

        if (JSON_ERROR_NONE !== json_last_error()) {
            return Response::json([
                'success' => false,
                'message' => 'Invalid data sent by tripay',
            ]);
        }

        // $invoiceId = $data->merchant_ref;
        $tripayReference = $data->reference;
        $status = strtoupper((string) $data->status);
        if ($data->is_closed_payment === 1) {
            $topupAgen = TopupAgen::query()->where('invoice_id', $tripayReference)->first();
            $user = User::query()->where('id', $topupAgen->user_id)->first();
            switch ($status) {
                case 'PAID':
                    $topupAgen->update(['status' => StatusTransactionEnum::PAID->value]);
                    $user->update(['saldo' => $user->saldo + $data->amount_received]);
                    break;

                    // case 'EXPIRED':
                    //     $invoice->update(['status' => 'EXPIRED']);
                    //     break;

                    // case 'FAILED':
                    //     $invoice->update(['status' => 'FAILED']);
                    //     break;

                    // default:
                    //     return Response::json([
                    //         'success' => false,
                    //         'message' => 'Unrecognized payment status',
                    //     ]);
            }

            return ResponseHelper::success('success');
        }
    }

    /**
     * handleGenerateCallbackSignature
     *
     * @param  mixed $request
     * @return string
     */
    public static function handleGenerateCallbackSignature(Request $request): string
    {
        $privateKey = "fh5Nm-awLil-GXCuC-v5juf-0T4Lm";
        return hash_hmac('sha256', $request->getContent(), $privateKey);
    }

    /**
     * instructions
     *
     * @param  mixed $transaction
     * @return mixed
     */
    public function instructions(TopupAgen $topupAgen): mixed
    {
        $apiKey = env('TRIPAY_API_KEY');

        $payload = ['code' => $topupAgen->payment_method, 'allow_html' => 1, 'pay_code' => $topupAgen->pay_code];
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_URL            => env('TRIPAY_API_URL') . '/payment/instruction?' . http_build_query($payload),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
            CURLOPT_FAILONERROR    => false,
            CURLOPT_IPRESOLVE      => CURL_IPRESOLVE_V4
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        return $response ? $response : $error;
    }
}
