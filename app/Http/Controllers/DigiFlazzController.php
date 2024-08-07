<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Contracts\Interfaces\Dashboard\DepositInterface;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\Dashboard\TransactionInterface;
use App\Enums\StatusDigiFlazzEnum;
use App\Helpers\FormatedHelper;
use App\Helpers\ResponseHelper;
use App\Http\Requests\BlazzUpdateProductRequest;
use App\Http\Requests\DepositRequest;
use App\Jobs\BlazzTopUpJob;
use App\Models\Customer;
use App\Models\Transaction;
use App\Services\Dashboard\DigiFlazzService;
use Faker\Provider\Uuid;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DigiFlazzController extends Controller
{
    private ProductInterface $product;
    private DepositInterface $deposit;
    private TransactionInterface $transaction;
    private DigiFlazzService $service;
    private CustomerInterface $customer;

    public function __construct(ProductInterface $product, DepositInterface $deposit, TransactionInterface $transaction, DigiFlazzService $service, CustomerInterface $customer)
    {
        $this->product = $product;
        $this->customer = $customer;
        $this->service = $service;
        $this->transaction = $transaction;
        $this->deposit = $deposit;
    }
    public function getPriceList(Request $request): JsonResponse
    {
        $priceList = $this->product->getPriceList($request);

        if ($request->ajax()) {
            return response()->json($priceList);
        }

        return response()->json($priceList);
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
    public function transaction(Customer $customer)
    {
        $product = $this->product->show($customer->product->id);
        if ($product->selling_price > auth()->user()->saldo) {
            return redirect()->back()->withErrors('Saldo anda tidak mencukupi, untuk melakukan transaksi tersebut dibutuhkan saldo sebesar ' . FormatedHelper::rupiahCurrency($product->selling_price) . ' sedangkan saldo anda saat ini adalah ' . FormatedHelper::rupiahCurrency(auth()->user()->saldo));
        }
        $service = $this->service->topUp($customer, false, $this->product, $this->transaction);
        if ($service === true) {
            return redirect()->back()->with('success', 'Berhasil mengirim saldo');
        } else {
            return redirect()->back()->withErrors($service);
        }
    }


    /**
     * repeatTransaction
     *
     * @param  mixed $customer
     * @return void
     */
    public function repeatTransaction(Transaction $transaction)
    {
        $customer = $transaction->customer;
        $product = $this->product->show($customer->product->id);
        if ($product->selling_price > auth()->user()->saldo) {
            return redirect()->back()->withErrors('Saldo anda tidak mencukupi, untuk melakukan transaksi tersebut dibutuhkan saldo sebesar ' . FormatedHelper::rupiahCurrency($product->selling_price) . ' sedangkan saldo anda saat ini adalah ' . FormatedHelper::rupiahCurrency(auth()->user()->saldo));
        }
        $service = $this->service->repeatTopUp($transaction, $customer, $this->product);
        if ($service === true) {
            return redirect()->back()->with('success', 'Berhasil melakukan topup ulang');
        } else {
            return redirect()->back()->withErrors($service);
        }
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
        Log::info($request);
        Log::info($request->header());

        if ($request->header('X-Hub-Signature') == 'sha1=' . $signature) {
            Log::info(json_decode($request->getContent(), true));
            $logContent = json_decode($request->getContent(), true);
            $logContent['data']['ref_id'];
            $transaction = $this->transaction->getWhere(['ref_id' => $logContent['data']['ref_id']]);
            $product = $this->product->getProduct(['buyer_sku_code' => $logContent['data']['buyer_sku_code']]);
            $agen = $transaction->customer->user;
            if ($logContent['data']['status'] == StatusDigiFlazzEnum::SUCCESS->value) {
                $agen->update(['saldo' => $agen->saldo - $product->selling_price]);
            }
            $transaction->update([
                'status' => $logContent['data']['status'],
                'message' => $logContent['data']['message']
            ]);

            // dd(json_decode($request->getContent(), true));
        } else {
            Log::info('Signature not match');
        }
    }

    /**
     * blazzTopUp
     *
     * @return void
     */
    public function blazzTopUp(BlazzUpdateProductRequest $request)
    {
        $data = $request->validated();

        $selling_price = 0;
        foreach ($data['checkedValues'] as $customer_id) {
            $customer = $this->customer->show($customer_id);
            $product = $customer->product;
            $selling_price += $product->selling_price;
        }

        if ($selling_price > auth()->user()->saldo) {
            $customer = $this->customer->show($customer_id);
            return ResponseHelper::error(null, 'Saldo anda tidak mencukupi, untuk melakukan transaksi tersebut dibutuhkan saldo sebesar ' . FormatedHelper::rupiahCurrency($selling_price) . ' sedangkan saldo anda saat ini adalah ' . FormatedHelper::rupiahCurrency(auth()->user()->saldo), 400);
        }

        $uuid = Uuid::uuid();
        $cropUuid = explode('-', $uuid)[0];
        $blazz_id = "MPLS-BLZZ-" . $cropUuid;

        foreach ($data['checkedValues'] as $customer_id) {
            $customer = $this->customer->show($customer_id);

            Queue::push(new BlazzTopUpJob($customer, $blazz_id, $this->product, $this->transaction));
        }

        return ResponseHelper::success(null, 'Berhasil Melakukan Top Up.');
    }
}
