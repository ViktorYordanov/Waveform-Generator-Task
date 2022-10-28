<?php

namespace App;

class Analyzer
{
    public function getLongestTimeSpoken(TimePeriods $tp): float
    {
        $longest = 0;
        foreach ($tp->getPeriods() as $p) {
            $time = $p[1] - $p[0];
            if ($time > $longest) {
                $longest = $time;
            }
        }

        return round($longest, 2);
    }

    public function getTalkPercent(float $person1_total, float $person2_total): float
    {
        $total = $person1_total + $person2_total;
        return round(($person1_total / $total) * 100, 2);
    }
}