<?php

namespace App\Contracts\Repositories\Dashboard;

use App\Contracts\Interfaces\Dashboard\CustomerInterface;
use App\Contracts\Interfaces\Dashboard\TopupAgenInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Enums\UserRoleEnum;
use App\Helpers\UserHelper;
use App\Models\Customer;
use App\Models\TopupAgen;
use App\Models\User;
use App\Traits\Datatables\UserDatatable;
use Illuminate\Http\Request;

class TopupAgenRepository extends BaseRepository implements TopupAgenInterface
{
    public function __construct(TopupAgen $topupAgen)
    {
$this->model=$topupAgen;
    }
    public function get():mixed{
        return $this->model->query()->get();
    }
    public function store(array $data):mixed{
        return $this->model->query()->create($data);
    }
}
