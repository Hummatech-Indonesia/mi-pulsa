<?php

namespace App\Contracts\Interfaces\Dashboard;

use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;

interface TopupAgenInterface extends GetInterface,StoreInterface,SearchInterface
{


}
