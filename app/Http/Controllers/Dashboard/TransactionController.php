<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Contracts\Interfaces\Dashboard\ProductInterface;
use App\Contracts\Interfaces\Dashboard\TopupAgenInterface;
use App\Contracts\Interfaces\Dashboard\TransactionInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CustomerRequest;
use App\Http\Requests\RequestTransactionWhatsappRequest;
use App\Services\Dashboard\DigiFlazzService;
use App\Services\Dashboard\TransactionService;
use App\Traits\PaginationTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use PaginationTrait;
    private TopupAgenInterface $topup;
    private CustomerInterface $customer;
    private TransactionService $service;
    private TransactionInterface $transaction;
    private ProductInterface $product;
    private DigiFlazzService $digiFlazzService;
    public function __construct(TopupAgenInterface $topup, TransactionService $service, CustomerInterface $customer, ProductInterface $product, TransactionInterface $transaction, DigiFlazzService $digiFlazzService)
    {
        $this->customer = $customer;
        $this->transaction = $transaction;
        $this->topup = $topup;
        $this->product = $product;
        $this->service = $service;
        $this->digiFlazzService = $digiFlazzService;
    }
    /**
     * Method store
     *
     * @param RequestTransactionWhatsappRequest $request [explicite description]
     *
     * @return RedirectResponse
     */
    public function store(RequestTransactionWhatsappRequest $request): RedirectResponse
    {
        if (intval($request['balance']) < 50000) {
            return back()->with('error', 'Nominal penarikan minimal adalah Rp.50.000');
        }
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
     * Method topupCustomer
     *
     * @param CustomerRequest $request [explicite description]
     *
     * @return RedirectResponse
     */
    public function topupCustomer(CustomerRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->user()->id;
        $customer = $this->customer->store($data);
        $service = $this->digiFlazzService->topUp($customer, false, $this->product, $this->transaction);
        if ($service == true) {
            return to_route('dashboard.topup.history')->with('success', 'Berhasil mengirim saldo, Status pending');
        } else {
            return redirect()->back()->withErrors($service);
        }
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

    /**
     * historyTopupCustomer
     *
     * @param  mixed $request
     * @return View
     */
    public function historyTopupCustomer(Request $request)
    {
        $request->merge(['blazz' => 0]);
        $transactions = $this->transaction->customPaginate($request);
        return view('dashboard.pages.customers.history', compact('transactions'));
    }

    /**
     * historyTopupCustomer
     *
     * @param  mixed $request
     * @return void
     */
    public function historyTopupCustomerMultiple(Request $request)
    {
        $transactions = $this->transaction->historyTransactionMultiple($request);
        return view('dashboard.pages.customers.multiple-history', compact('transactions'));
    }

    /**
     * detailHistoryTopupCustomerMultiple
     *
     * @param  mixed $request
     * @return void
     */
    public function detailHistoryTopupCustomerMultiple(string $blazz_id, Request $request)
    {
        $request->merge(['blazz_id' => $blazz_id]);
        $request->merge(['blazz' => 1]);
        $transactions = $this->transaction->customPaginate($request);
        return view('dashboard.pages.customers.detail-multiple-history', compact('transactions'));
    }

    /**
     * jsonCustomer
     *
     * @param  mixed $request
     * @return JsonResponse
     */
    public function jsonCustomer(Request $request): JsonResponse
    {
        $customers = $this->customer->customPaginate($request, $request->pagination);
        $data['paginate'] = $this->customPaginate($customers->currentPage(), $customers->lastPage());
        $data['data'] = $customers;
        return ResponseHelper::success($data);
    }
}
