<?php

namespace App\Http\Controllers;

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

    // public function FunctionName() : Returntype {

    // }
}
