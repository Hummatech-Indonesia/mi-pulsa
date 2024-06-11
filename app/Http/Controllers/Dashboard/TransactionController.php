<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Dashboard\TopupAgenInterface;
use App\Http\Controllers\Controller;
use App\Models\TopupAgen;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    private TopupAgenInterface $topup;
    public function __construct(TopupAgenInterface $topup)
    {
        $this->topup = $topup;
    }
    public function historyTransaction()
    {
        $topups = $this->topup->get();
        return view('dashboard.pages.transactions.history', compact('topups'));
    }
}
