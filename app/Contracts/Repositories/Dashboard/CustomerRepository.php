<?php

namespace App\Contracts\Repositories\Dashboard;

use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Enums\UserRoleEnum;
use App\Helpers\UserHelper;
use App\Models\Customer;
use App\Models\User;
use App\Traits\Datatables\UserDatatable;
use Illuminate\Http\Request;

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
        return $this->model->query()->fastPaginate(10);
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
}
