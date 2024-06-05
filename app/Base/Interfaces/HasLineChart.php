<?php

namespace App\Base\Interfaces;

interface HasLineChart
{
    /**
     * Determine if the models has line chart implementation
     *
     * @param string $start_date
     * @param string $end_date
     * @return object
     */

    public function hasLineChart(string $start_date, string $end_date): object;
}
