<?php

namespace App\Contracts\Interfaces\Dashboard;

use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface AboutInterface extends GetInterface,StoreInterface,UpdateInterface
{


}
