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

    public function __construct(TripayService $service, UserInterface $user)
    {
        $this->service = $service;
        $this->user = $user;
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
    /**
     * transactionWhatsapp
     *
     * @param  mixed $request
     * @return View
     */
    public function transactionWhatsapp(Request $request): View
    {
        $paymentChannels = $this->service->paymentChannel();
        $users = $this->user->searchAgen($request);
        return view('dashboard.pages.packages.transaction-whatsapp', compact('paymentChannels', 'users'));
    }
}
