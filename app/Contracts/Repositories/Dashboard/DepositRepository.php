<?php

namespace App\Contracts\Repositories\Dashboard;

use App\Contracts\Interfaces\Dashboard\DepositInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\Deposit;
use App\Models\Product;
use Illuminate\Http\Request;

class DepositRepository extends BaseRepository implements DepositInterface
{
    public function __construct(Deposit $product)
    {
        $this->model = $product;
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
}
