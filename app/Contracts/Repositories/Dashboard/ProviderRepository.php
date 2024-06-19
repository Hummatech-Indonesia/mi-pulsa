<?php

namespace App\Contracts\Repositories\Dashboard;

use App\Contracts\Interfaces\Dashboard\ProviderInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProviderRepository extends BaseRepository implements ProviderInterface
{
    public function __construct(Provider $provider)
    {
        $this->model = $provider;
    }


    /**
     * get
     *
     * @return mixed
     */
    public function customPaginate(Request $request, int $pagination = 10): LengthAwarePaginator
    {
        return $this->model->query()
            ->fastPaginate($pagination);
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
     * delete
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->model->query()
            ->delete($id);
    }

    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()
            ->findOrFail($id)
            ->update($data);
    }
}
