<?php

namespace App\Contracts\Interfaces\Dashboard;

use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\GetWhereInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;

interface ProductInterface extends BaseInterface, SearchInterface, GetWhereInterface
{
    /**
     * Handle get data event from models.
     *
     * @param array $data
     *
     * @return mixed
     */

    public function getProduct(array $data): mixed;
}
