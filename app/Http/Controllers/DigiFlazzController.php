<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Dashboard\DepositInterface;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\Dashboard\TransactionInterface;
use App\Helpers\FormatedHelper;
use App\Helpers\ResponseHelper;
use App\Http\Requests\DepositRequest;
use App\Http\Requests\TransactionRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DigiFlazzController extends Controller
{
    private ProductInterface $product;
    private DepositInterface $deposit;
    private TransactionInterface $transaction;

    public function __construct(ProductInterface $product, DepositInterface $deposit, TransactionInterface $transaction)
    {
        $this->product = $product;
        $this->transaction = $transaction;
        $this->deposit = $deposit;
    }

    /**
     * cekSaldo
     *
     * @return void
     */
    public function cekSaldo()
    {
        $username = env('DIGIFLAZZ_USERNAME');
        $devKey = env('DIGIFLAZZ_DEVELOPMENT_KEY');

        $message = $username . $devKey . 'depo';
        $hash = md5($message);

        $postData = [
            "cmd" => "deposit",
            "username" => $username,
            "sign" => $hash
        ];

        $response = Http::post('https://api.digiflazz.com/v1/cek-saldo', $postData);

        return $response->json();
    }

    /**
     * priceList
     *
     * @return void
     */
    public function priceList()
    {
        $username = env('DIGIFLAZZ_USERNAME');
        $devKey = env('DIGIFLAZZ_DEVELOPMENT_KEY');

        $message = $username . $devKey . 'pricelist';
        $hash = md5($message);

        $postData = [
            "cmd" => "prepaid",
            "username" => $username,
            "sign" => $hash
        ];

        $response = Http::post('https://api.digiflazz.com/v1/price-list', $postData);

        $data = $response->json();
        foreach ($data['data'] as $product) {
            $getProduct = $this->product->getWhere(['product_name' => $product['product_name']]);
            if ($getProduct == null) {
                $product['selling_price'] = $product['price'];
                $this->product->store([
                    'selling_price' => $product['price'],
                    'product_name' => $product['product_name'],
                    'brand' => $product['brand'],
                    'buyer_sku_code' => $product['buyer_sku_code'],
                    'desc' => $product['desc'],
                    'price' => $product['price'],
                    'selling_price' => $product['selling_price']
                ]);
            } else {
                if ($getProduct->product_name != $product['product_name'] || $getProduct->brand != $product['brand'] || $getProduct->buyer_sku_code != $product['buyer_sku_code'] || $getProduct->desc != $product['desc'] || $getProduct->price != $product['price']) {
                    $this->product->update(
                        $getProduct->id,
                        [
                            'product_name' => $product['product_name'],
                            'brand' => $product['brand'],
                            'buyer_sku_code' => $product['buyer_sku_code'],
                            'desc' => $product['desc'],
                            'price' => $product['price']
                        ]
                    );
                }
            }
        }
        return $response->json();
    }

    /**
     * deposit
     *
     * @return void
     */
    public function deposit(DepositRequest $request)
    {
        $data = $request->validated();
        $username = env('DIGIFLAZZ_USERNAME');
        $devKey = env('DIGIFLAZZ_DEVELOPMENT_KEY');

        $message = $username . $devKey . 'deposit';
        $hash = md5($message);


        $postData = json_encode([
            "username" => $username,
            "amount" => intval($data['amount']),
            "Bank" => $data['bank'],
            "owner_name" => auth()->user()->name,
            "sign" => $hash
        ]);

        try {
            $header = array(
                'Content-Type: application/json',
            );
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.digiflazz.com/v1/deposit');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            $result = curl_exec($ch);
            // dd($result);
            $data = json_decode($result)->data;


            if ($data->rc != '00') {
                return to_route('dashboard.topup.digiflazz')->with('error', $data->message);
            }

            $this->deposit->store([
                'rc' => $data->rc,
                'amount' => $data->amount,
                'notes' => $data->notes
            ]);

            return to_route('dashboard.topup.digiflazz')->with('success', 'Total saldo yang harus anda bayarkan adalah Rp. ' . FormatedHelper::rupiahCurrency($data->amount) . ' Dan masukkan catatan ' . $data->notes . ' Ketika anda melakukan transaksi');
        } catch (\Throwable $th) {
            return to_route('dashboard.topup.digiflazz')->with('error', 'Terjadi kesalahan saat melakukan deposit');
        }
    }

    /**
     * transaction
     *
     * @param  mixed $customer
     * @return JsonResponse
     */
    public function transaction(Customer $customer, TransactionRequest $request)
    {
        $username = env('DIGIFLAZZ_USERNAME');
        $developmentKey = env('DIGIFLAZZ_DEVELOPMENT_KEY');

        $message = $username . $developmentKey . 'some3d';
        $hash = md5($message);

        $product = $this->product->getProduct(['buyer_sku_code' => $request->product_id]);

        $postData = [
            "username" => $username,
            "buyer_sku_code" => $request->product_id,
            "customer_no" => $customer->phone_number,
            "ref_id" => "some3d",
            "sign" => $hash,
            "testing" => true
        ];

        $response = Http::post('https://api.digiflazz.com/v1/transaction', $postData);
        $data = $response->json()['data'];
        $this->transaction->store([
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'ref_id' => $data['ref_id'],
            'customer_no' => $data['customer_no'],
            'buyer_last_saldo' => $data['buyer_last_saldo'],
            'price' => $data['price'],
            'tele' => $data['tele'],
            'wa' => $data['wa']
        ]);
        return redirect()->back()->with('success', 'Berhasil Mengirim Saldo');
    }

    /**
     * callback
     * 
     * @param  mixed $request
     * @return void
     */
    public function callback(Request $request)
    {
        $secret = 'testing';

        $post_data = file_get_contents('php://input');
        $signature = hash_hmac('sha1', $post_data, $secret);
        Log::info($signature);
        Log::info($post_data);

        if ($request->header('X-Hub-Signature') == 'sha1=' . $signature) {
            Log::info(json_decode($request->getContent(), true));
            // dd(json_decode($request->getContent(), true));
        } else {
            Log::info('Signature not match');
        }
    }
}
