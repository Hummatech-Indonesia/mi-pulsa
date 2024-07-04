<?php

namespace App\Contracts\Interfaces\Dashboard;

use App\Base\Interfaces\Notification\CountInterface;
use App\Contracts\Interfaces\Eloquent\CustomPaginationInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\GetWhereInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


interface TransactionInterface extends StoreInterface, GetWhereInterface, CustomPaginationInterface, CountInterface
{

    /**
     * historyTransactionMultiple
     *
     * @param  mixed $request
     * @param  mixed $pagination
     * @return mixed
     */
    public function historyTransactionMultiple(Request $request, int $pagination = 10): mixed;

    /**
     * count provided notifications
     *
     * @return int
     */

    public function count_agen(): int;

    /**
     * count_agen_status
     *
     * @return int
     */
    public function count_agen_status(array $data): int;

    /**
     * count_status
     *
     * @param  mixed $data
     * @return int
     */
    public function count_status(array $data): int;
}
