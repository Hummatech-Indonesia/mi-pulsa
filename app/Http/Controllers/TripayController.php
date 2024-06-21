<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\RequestTransactionWhatsappRequest;
use App\Http\Requests\Tripay\RequestTransactionRequest;
use App\Models\TopupAgen;
use App\Services\Auth\TripayService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
     * Method requestTransaction
     *
     * @param RequestTransactionRequest $request [explicite description]
     *
     * @return View
     */
    public function requestTransaction(RequestTransactionRequest $request): View
    {
        $service = $this->service->requestTransaction($request);
        return view('dashboard.pages.packages.checkout', compact('service'));
    }

    /**
     * instructions
     *
     * @param  mixed $topupAgen
     * @return void
     */
    public function instructions(TopupAgen $topupAgen): JsonResponse
    {
        $service = $this->service->instructions($topupAgen);
        return ResponseHelper::success(json_decode($service)->data);
    }

    /**
     * callback
     *
     * @return void
     */
    public function callback(Request $request)
    {
        $service = $this->service->callback($request);
        return $service;
    }
}
