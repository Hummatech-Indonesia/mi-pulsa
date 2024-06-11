<?php

namespace App\Http\Controllers\Dashboard;

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
    private TransactionService $service;
    public function __construct(TopupAgenInterface $topup,TransactionService $service)
    {
        $this->topup = $topup;
        $this->service = $service;
    }
    public function store(RequestTransactionWhatsappRequest $request){
        $this->topup->store($this->service->store($request));
        return to_route('transactions.history');
    }
    public function historyTransaction(Request $request):View
    {
        $topups = $this->topup->search($request);
        return view('dashboard.pages.transactions.history', compact('topups'));
    }
}
