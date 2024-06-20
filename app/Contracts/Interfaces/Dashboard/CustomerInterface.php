<?php

namespace App\Contracts\Interfaces\Dashboard;

use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\CustomPaginationInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;

interface CustomerInterface extends BaseInterface,SearchInterface, CustomPaginationInterface
{


}
