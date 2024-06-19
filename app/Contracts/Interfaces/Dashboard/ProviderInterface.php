<?php

namespace App\Contracts\Interfaces\Dashboard;

use App\Contracts\Interfaces\Eloquent\CustomPaginationInterface;
use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface ProviderInterface extends CustomPaginationInterface, StoreInterface, DeleteInterface, UpdateInterface
{
}
