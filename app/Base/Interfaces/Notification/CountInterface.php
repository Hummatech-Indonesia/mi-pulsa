<?php

namespace App\Base\Interfaces\Notification;

interface CountInterface
{
    /**
     * count provided notifications
     *
     * @return int
     */

    public static function count(): int;
}
