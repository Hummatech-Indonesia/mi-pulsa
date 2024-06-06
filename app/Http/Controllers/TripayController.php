<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tripay\RequestTransactionRequest;
use App\Services\Auth\TripayService;

class TripayController extends Controller
{
    private TripayService $service;

    public function __construct(TripayService $service)
    {
        $this->service = $service;
    }

    /**
     * paymentChannel
     *
     * @return void
     */
    public function paymentChannel()
    {
        $data = $this->service->paymentChannel();
        $response = json_decode($data);
        $data = $response->data;
        return $data;
    }

    /**
     * requestTransaction
     *
     * @param  mixed $request
     * @return void
     */
    public function requestTransaction(RequestTransactionRequest $request)
    {
        $service = $this->service->requestTransaction($request);
        return $service;
    }
}
