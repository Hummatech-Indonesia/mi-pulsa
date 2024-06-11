<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;

interface UserInterface extends BaseInterface,SearchInterface
{
/**
 * Method getAgen
 *
 * @return mixed
 */
public function getAgen():mixed;


}
