<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Http\Requests\DepositRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class DigiFlazzController extends Controller
{
    private ProductInterface $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
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
            $product['selling_price'] = $product['price'];
            $this->product->store($product);
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
        $username = env('DIGIFLAZZ_USERNAME');
        $developmentKey = env('DIGIFLAZZ_DEVELOPMENT_KEY');

        $message = $username . $developmentKey . 'pricelist';
        $hash = md5($message);

        $postData = [
            "username" => $username,
            "amount" => 1000000,
            "Bank" => "BCA",
            "owner_name" => auth()->user()->name,
            "sign" => $hash
        ];

        $response = Http::post('https://api.digiflazz.com/v1/price-list', $postData);
        return $response->json();
    }
}
