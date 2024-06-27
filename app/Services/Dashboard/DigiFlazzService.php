<?php

namespace App\Services\Dashboard;

use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\Dashboard\TransactionInterface;
use App\Enums\StatusDigiFlazzEnum;
use App\Models\Customer;
use Faker\Provider\Uuid;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class DigiFlazzService
{
    // private TransactionInterface $transaction;
    // private ProductInterface $product;

    // public function __construct(TransactionInterface $transaction, ProductInterface $product)
    // {
    //     $this->transaction = $transaction;
    //     $this->product = $product;
    // }
    /**
     * topUp
     *
     * @param  mixed $customer
     * @return void
     */
    public function topUp(Customer $customer, $blazz = false, ProductInterface $product, TransactionInterface $transaction)
    {
        $username = env('DIGIFLAZZ_USERNAME');
        $developmentKey = env('DIGIFLAZZ_DEVELOPMENT_KEY');

        $ref_id = Str::random(5);
        $message = $username . $developmentKey . $ref_id;
        $hash = md5($message);

        $user = $customer->user;

        $postData = [
            "username" => $username,
            "buyer_sku_code" => $customer->product->buyer_sku_code,
            "customer_no" => $customer->phone_number,
            "ref_id" => $ref_id,
            "sign" => $hash,
        ];

        $product = $product->getProduct(['buyer_sku_code' => $customer->product->buyer_sku_code]);

        try {
            $response = Http::post('https://api.digiflazz.com/v1/transaction', $postData);
            $data = $response->json()['data'];
            if ($blazz != false) {
                $blazz_id = $blazz;
            } else {
                $blazz_id = null;
            }
            if ($data['status'] == "Sukses" || $data['status'] == StatusDigiFlazzEnum::PENDING->value) {
                $transaction->store([
                    'customer_id' => $customer->id,
                    'blazz_id' => $blazz_id,
                    'product_id' => $customer->product->id,
                    'ref_id' => $data['ref_id'],
                    'customer_no' => $data['customer_no'],
                    'buyer_last_saldo' => $data['buyer_last_saldo'] ?? null,
                    'price' => $product->selling_price,
                    'status' => $data['status'] ?? null,
                    'message' => $data['message'] ?? null,
                    'tele' => $data['tele'] ?? null,
                    'wa' => $data['wa'] ?? null
                ]);
                if ($data['status'] == "Sukses") {
                    $user->update(['saldo' => $user->saldo - $product->selling_price]);
                }
                return true;
            } else {
                $transaction->store([
                    'customer_id' => $customer->id,
                    'blazz_id' => $blazz_id,
                    'product_id' => $customer->product->id,
                    'ref_id' => $data['ref_id'],
                    'customer_no' => $data['customer_no'],
                    'status' => $data['status'] ?? null,
                    'message' => $data['message'] ?? null,
                ]);
                return $data['message'];
            }
        } catch (\Throwable $th) {
            return false;
        }
    }
}
