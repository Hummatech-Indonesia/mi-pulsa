<?php

namespace App\Contracts\Interfaces\Dashboard;

use App\Base\Interfaces\Notification\CountInterface;
use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\CustomPaginationInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use Illuminate\Http\Request;

interface CustomerInterface extends BaseInterface, SearchInterface, CustomPaginationInterface, CountInterface
{
    /**
     * ajaxDatatable
     *
     * @param  mixed $request
     * @param  mixed $pagination
     * @return void
     */
    public function ajaxDatatable(Request $request, int $pagination = 10);
}
