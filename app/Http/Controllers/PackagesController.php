<?php

namespace App\Http\Controllers;

use App\Services\Auth\TripayService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackagesController extends Controller
{
    private TripayService $service;

    public function __construct(TripayService $service)
    {
        $this->service = $service;
    }

    /**
     * Method index
     *
     * @return View
     */
    public function index(): View
    {
        $paymenyChannel = $this->service->paymentChannel();
        return view('dashboard.pages.packages.index', compact('paymentChannel'));
    }
}
