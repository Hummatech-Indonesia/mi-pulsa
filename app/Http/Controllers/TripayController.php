<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
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
        if ($response->success == true) {
            $data = $response->data;
            return ResponseHelper::success($data);
        } else {
            return ResponseHelper::error($response->message);
        }
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
