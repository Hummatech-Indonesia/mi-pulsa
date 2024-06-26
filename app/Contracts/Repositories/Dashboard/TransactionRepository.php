<?php

namespace App\Contracts\Repositories\Dashboard;

use App\Contracts\Interfaces\Dashboard\TransactionInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TransactionRepository extends BaseRepository implements TransactionInterface
{
    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
    }

    /**
     * store
     *
     * @param  mixed $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()
            ->create($data);
    }

    /**
     * getWhere
     *
     * @param  mixed $data
     * @return mixed
     */
    public function getWhere(array $data): mixed
    {
        return $this->model->query()
            ->where('ref_id', $data['ref_id'])
            ->first();
    }

    /**
     * customPaginate
     *
     * @param  mixed $request
     * @param  mixed $pagination
     * @return LengthAwarePaginator
     */
    public function customPaginate(Request $request, int $pagination = 10): LengthAwarePaginator
    {
        return $this->model->query()
            ->when($request->name, function ($query) use ($request) {
                $query->whereRelation('customer', 'name', 'like', '%' . $request->name . '%');
            })
            ->when($request->blazz == 1, function ($query) {
                $query->where('blazz_id', '!=', null);
            })
            ->when($request->blazz == 0, function ($query) {
                $query->where('blazz_id', null);
            })
            ->when($request->blazz_id, function ($query) use ($request) {
                $query->where('blazz_id', $request->blazz_id);
            })
            ->latest()
            ->fastPaginate(5);
    }

    /**
     * historyTransactionMultiple
     *
     * @param  mixed $request
     * @param  mixed $pagination
     * @return mixed
     */
    public function historyTransactionMultiple(Request $request, int $pagination = 10): mixed
    {
        return $this->model->query()->select('blazz_id', DB::raw('MAX(created_at) AS created_at'))
            ->where('blazz_id', '!=', null)
            ->groupBy('blazz_id')
            ->latest()
            ->fastPaginate(5);
    }
}
