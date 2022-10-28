<?php

use App\Analyzer;
use App\TimePeriods;
use PHPUnit\Framework\TestCase;

class AnalyzerTest extends TestCase
{
    /**
     * @test
     */
    public function get_longest_time(): void
    {
        $periods = new TimePeriods();
        $periods->addPeriod(0, 5);
        $periods->addPeriod(6, 10);
        $periods->addPeriod(15.3, 28.64);
        $periods->addPeriod(30, 31);

        $analyzer = new Analyzer();
        $expected = 13.34;
        $this->assertEquals($expected, $analyzer->getLongestTimeSpoken($periods));
    }

    /**
     * @test
     */
    public function check_user_talk_percent(): void
    {
        // user talked for 10 seconds total
        // customer talked for 30 seconds total
        $expected = 25; // ( 10 / 40 ) * 100
        $analyzer = new Analyzer();
        $this->assertEquals($expected, $analyzer->getTalkPercent(10, 30));
    }
}