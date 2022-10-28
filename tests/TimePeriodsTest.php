<?php

use App\TimePeriods;
use PHPUnit\Framework\TestCase;

class TimePeriodsTest extends TestCase
{
    /**
     * @test
     */
    public function check_if_periods_are_added_properly(): void
    {
        $periodsData = new TimePeriods();

        $periodsData->addPeriod(0,2.5);
        $periodsData->addPeriod('3.71','12.56');

        $expected = [
            ['0', '2.5'],
            ['3.71', '12.56']
        ];
        $this->assertEquals($expected, $periodsData->getPeriods());
    }

    /**
     * @test
     */
    public function is_the_total_calculated_properly(): void
    {
        $periodsData = new TimePeriods();

        $periodsData->addPeriod(0,3.504);
        $periodsData->addPeriod(6.656,14);

        $expected = 10.848;
        $total = $periodsData->getTotal();
        $this->assertIsFloat($total);
        $this->assertEquals($expected, $total);
    }
}