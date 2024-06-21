<?php

namespace App\Services\Dashboard;

use App\Contracts\Interfaces\Dashboard\TransactionInterface;
use App\Models\Customer;
use Faker\Provider\Uuid;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class DigiFlazzService
{
    private TransactionInterface $transaction;

    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }
    /**
     * topUp
     *
     * @param  mixed $customer
     * @return void
     */
    public function topUp(Customer $customer, $blazz = false)
    {
        $username = env('DIGIFLAZZ_USERNAME');
        $developmentKey = env('DIGIFLAZZ_DEVELOPMENT_KEY');

        $ref_id = Str::random(5);
        $message = $username . $developmentKey . $ref_id;
        $hash = md5($message);


        $postData = [
            "username" => $username,
            "buyer_sku_code" => $customer->product->buyer_sku_code,
            "customer_no" => $customer->phone_number,
            "ref_id" => $ref_id,
            "sign" => $hash,
            "testing" => true
        ];

        try {
            $response = Http::post('https://api.digiflazz.com/v1/transaction', $postData);
            $data = $response->json()['data'];
            if ($blazz) {
                $blazz_id = Uuid::uuid();
            } else {
                $blazz_id = null;
            }
            if ($data['rc'] == "") {
                $this->transaction->store([
                    'customer_id' => $customer->id,
                    'blazz_id' => $blazz_id,
                    'product_id' => $customer->product->id,
                    'ref_id' => $data['ref_id'],
                    'customer_no' => $data['customer_no'],
                    'buyer_last_saldo' => $data['buyer_last_saldo'],
                    'price' => $data['price'],
                    'status' => $data['status'],
                    'tele' => $data['tele'],
                    'status' => $data['status'],
                    'wa' => $data['wa']
                ]);
                return true;
            } else {
                return $data['message'];
            }
        } catch (\Throwable $th) {
            return false;
        }
    }
}
