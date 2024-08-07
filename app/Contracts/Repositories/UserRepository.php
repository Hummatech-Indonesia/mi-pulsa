<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\UserInterface;
use App\Enums\RoleEnum;
use App\Enums\UserRoleEnum;
use App\Helpers\UserHelper;
use App\Models\User;
use App\Traits\Datatables\UserDatatable;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository implements UserInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
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
            ->when($request->role, function ($query) use ($request) {
                $query->role($request->role);
            })
            ->role('admin')
            ->where('id', '!=', auth()->id()) // Exclude the currently logged-in user
            ->where('email', '!=', 'admin@gmail.com') // Exclude the currently logged-in user
            ->fastPaginate(5);
    }
    public function searchAgen(Request $request): mixed
    {
        return $this->model->query()
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->role, function ($query) use ($request) {
                $query->role($request->role);
            })
            ->role('agen')
            ->where('id', '!=', auth()->id()) // Exclude the currently logged-in user
            ->fastPaginate(5);
    }
    /**
     * Method getAgen
     *
     * @return mixed
     */
    public function getAgen(): mixed
    {
        return $this->model->query()->role(RoleEnum::AGEN->value)->get();
    }

    /**
     * takeAgen
     *
     * @return mixed
     */
    public function takeAgen(): mixed
    {
        return $this->model->query()->role(RoleEnum::AGEN->value)
            ->orderBy('saldo', 'desc')
            ->take(10)
            ->get();
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
     * count
     *
     * @return int
     */
    public function count(): int
    {
        return $this->model->query()->count();
    }
}
