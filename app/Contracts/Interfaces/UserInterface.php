<?php

namespace App\Contracts\Interfaces;

use App\Base\Interfaces\Notification\CountInterface;
use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use Illuminate\Http\Request;

interface UserInterface extends BaseInterface, SearchInterface, CountInterface
{
    /**
     * Method getAgen
     *
     * @return mixed
     */
    public function getAgen(): mixed;

    /**
     * takeAgen
     *
     * @return mixed
     */
    public function takeAgen(): mixed;

    /**
     * searchAgen
     *
     * @param  mixed $request
     * @return mixed
     */
    public function searchAgen(Request $request): mixed;
}
