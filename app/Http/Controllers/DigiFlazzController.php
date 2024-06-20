<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Dashboard\DepositInterface;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Helpers\FormatedHelper;
use App\Helpers\ResponseHelper;
use App\Http\Requests\DepositRequest;
use Illuminate\Support\Facades\Http;

class DigiFlazzController extends Controller
{
    private ProductInterface $product;
    private DepositInterface $deposit;

    public function __construct(ProductInterface $product, DepositInterface $deposit)
    {
        $this->product = $product;
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
        $developmentKey = env('DIGIFLAZZ_DEVELOPMENT_KEY');

        $message = $username . $developmentKey . 'depo';
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
        $developmentKey = env('DIGIFLAZZ_DEVELOPMENT_KEY');

        $message = $username . $developmentKey . 'pricelist';
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
        $developmentKey = env('DIGIFLAZZ_DEVELOPMENT_KEY');

        $message = $username . $developmentKey . 'deposit';
        $hash = md5($message);

        $postData = [
            "username" => $username,
            "amount" => intval($data['amount']),
            "Bank" => $data['bank'],
            "owner_name" => auth()->user()->name,
            "sign" => $hash
        ];

        try {
            $response = Http::post('https://api.digiflazz.com/v1/deposit', $postData);
            $data = $response->json()['data'];

            if ($data['rc'] != '00') {
                return to_route('dashboard.topup.digiflazz')->with('error', $data['message']);
            }

            $this->deposit->store([
                'rc' => $data['rc'],
                'amount' => $data['amount'],
                'notes' => $data['notes']
            ]);
            return to_route('dashboard.topup.digiflazz')->with('success', 'Total saldo yang harus anda bayarkan adalah Rp. <b>' . FormatedHelper::rupiahCurrency($data['amount']) . '</b> Dan masukkan catatan <b>' . $data['notes'] . '</b> Ketika anda melakukan transaksi');
        } catch (\Throwable $th) {
            return to_route('dashboard.topup.digiflazz')->with('error', 'Terjadi kesalahan saat melakukan deposit');
        }
    }
}
