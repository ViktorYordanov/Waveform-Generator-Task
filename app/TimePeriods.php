<?php

namespace App;

class TimePeriods
{
    /**
     * Total time spoken
     */
    protected $total = 0;

    /**
     * Time periods of speaking
     */
    protected $periods = [];

    /**
     * adds new time period and calculates the total
     */
    public function addPeriod($start, $end): void
    {
        $time = $end - $start;
        $this->total += floatval($time);
        $this->periods[] = [$start, $end];
    }

    /**
     * Returns the periods array
     */
    public function getPeriods(): array
    {
        return $this->periods;
    }

    public function getTotal(): float
    {
        return $this->total;
    }
} 