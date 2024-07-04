<?php

namespace App\Contracts\Interfaces\Dashboard;

use App\Base\Interfaces\Notification\CountInterface;
use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\GetWhereInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use Illuminate\Http\Request;

interface ProductInterface extends BaseInterface, SearchInterface, GetWhereInterface, CountInterface
{
    /**
     * Handle get data event from models.
     *
     * @param array $data
     *
     * @return mixed
     */

    public function getProduct(array $data): mixed;
    /**
     * Method getPriceList
     *
     * @param Request $request [explicite description]
     *
     * @return mixed
     */
    public function getPriceList(Request $request):mixed;
}
