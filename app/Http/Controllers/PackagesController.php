<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\UserInterface;
use App\Services\Auth\TripayService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PackagesController extends Controller
{
    private TripayService $service;
    private UserInterface $user;

    public function __construct(TripayService $service,UserInterface $user)
    {
        $this->service = $service;
        $this->user=$user;
    }

    /**
     * Method index
     *
     * @return View
     */
    public function index(): View
    {
        $paymentChannels = $this->service->paymentChannel();
        return view('dashboard.pages.packages.index', compact('paymentChannels'));
    }
    public function transactionWhatsapp(): View
    {
        $paymentChannels = $this->service->paymentChannel();
        $users=$this->user->getAgen();
        return view('dashboard.pages.packages.transaction-whatsapp', compact('paymentChannels','users'));
    }
    public function store(Request $request)
    {

    }
}
