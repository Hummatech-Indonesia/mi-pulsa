<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\Dashboard\TopupAgenInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\RequestTransactionWhatsappRequest;
use App\Models\TopupAgen;
use App\Services\Dashboard\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private TopupAgenInterface $topup;
    private CustomerInterface $customer;
    private TransactionService $service;
    private ProductInterface $product;
    public function __construct(TopupAgenInterface $topup, TransactionService $service, CustomerInterface $customer, ProductInterface $product)
    {
        $this->customer = $customer;
        $this->topup = $topup;
        $this->product = $product;
        $this->service = $service;
    }
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(RequestTransactionWhatsappRequest $request)
    {
        $this->topup->store($this->service->store($request));
        return to_route('transactions.history');
    }
    /**
     * historyTransaction
     *
     * @param  mixed $request
     * @return View
     */
    public function historyTransaction(Request $request): View
    {
        $topups = $this->topup->search($request);
        return view('dashboard.pages.transactions.history', compact('topups'));
    }

    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        $customers = $this->customer->customPaginate($request);
        $products = $this->product->get();
        return view('dashboard.pages.customers.topup-pulsa', compact('customers', 'products'));
    }
}
