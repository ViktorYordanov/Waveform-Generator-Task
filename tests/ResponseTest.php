<?php

use App\Analyzer;
use App\Response;
use App\TimePeriods;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    /**
     * @test
     */
    public function check_if_the_json_is_generated_properly()
    {
        $userPeriods = new TimePeriods();
        $userPeriods->addPeriod(0, 5); // 5
        $userPeriods->addPeriod(6, 10); // 4
        $userPeriods->addPeriod(30, 31); // 1
        // user total: 10

        $custPeriods = new TimePeriods();
        $custPeriods->addPeriod(0, 7); // 7
        $custPeriods->addPeriod(10, 15); // 5
        $custPeriods->addPeriod(27, 40); // 13
        // customer total: 25

        // Total: 35

        $response = new Response(new Analyzer());
        $json = $response->generateJson($userPeriods, $custPeriods);

        $expected = json_encode(
            [
                "longest_user_monologue" => 5,
                "longest_customer_monologue" => 13,
                "user_talk_percentage" => 28.57, // ( 10 / 35 ) * 100
                "user" => [
                    [0, 5],
                    [6, 10],
                    [30, 31]
                ],
                "customer" => [
                    [0, 7],
                    [10, 15],
                    [27, 40]
                ]
            ]
        );

        $this->assertEquals($expected, $response->generateJson($userPeriods, $custPeriods));
    }
}