<?php

namespace App\Contracts\Interfaces\Dashboard;

use App\Contracts\Interfaces\Eloquent\CustomPaginationInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\GetWhereInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


interface TransactionInterface extends StoreInterface, GetWhereInterface, CustomPaginationInterface
{

    /**
     * historyTransactionMultiple
     *
     * @param  mixed $request
     * @param  mixed $pagination
     * @return mixed
     */
    public function historyTransactionMultiple(Request $request, int $pagination = 10): mixed;
}
