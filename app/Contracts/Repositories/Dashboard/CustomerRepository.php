<?php

namespace App\Contracts\Repositories\Dashboard;

use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerRepository extends BaseRepository implements CustomerInterface
{
    public function __construct(Customer $customer)
    {
        $this->model = $customer;
    }
    /**
     * Method get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->where('user_id', auth()->user()->id)
            ->withCount('transactions')
            ->orderBy('transactions_count', 'desc')
            ->take(10)
            ->get();
    }

    /**
     * Method search
     *
     * @param Request $request [explicite description]
     *
     * @return mixed
     */
    public function search(Request $request): mixed
    {
        return $this->model->query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->where('user_id', auth()->user()->id)
            // ->when(auth()->user()->role == RoleEnum::AGEN->value, function FunctionName() : Returntype {

            // })
            ->fastPaginate(5);
    }

    /**
     * Method store
     *
     * @param array $data [explicite description]
     *
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }
    /**
     * Method show
     *
     * @param mixed $id [explicite description]
     *
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id);
    }
    /**
     * Method update
     *
     * @param mixed $id [explicite description]
     * @param array $data [explicite description]
     *
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->show($id)->update($data);
    }
    /**
     * Method delete
     *
     * @param mixed $id [explicite description]
     *
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->show($id)->delete();
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
                $query->where('name', 'like', '%' . $request->name . '%');
            })
            ->where('user_id', auth()->user()->id)
            ->fastPaginate($pagination);
    }

    /**
     * ajaxDatatable
     *
     * @param  mixed $request
     * @param  mixed $pagination
     * @return void
     */
    public function ajaxDatatable(Request $request, int $pagination = 10)
    {
        return $this->model->query()
            ->get();
    }

    /**
     * count
     *
     * @return int
     */
    public function count(): int
    {
        return $this->model->query()
            ->where('user_id', auth()->user()->id)
            ->count();
    }
}
