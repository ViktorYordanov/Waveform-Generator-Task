<?php

namespace App;

class Response
{
    /**
     * @var Analyzer
     */
    private $analizer;

    public function __construct(Analyzer $analyzer)
    {
        $this->analizer = $analyzer;
    }

    public function generateJson(TimePeriods $user, TimePeriods $cust): string
    {
        $response = [
            "longest_user_monologue" => $this->analizer->getLongestTimeSpoken($user),
            "longest_customer_monologue" => $this->analizer->getLongestTimeSpoken($cust),
            "user_talk_percentage" => $this->analizer->getTalkPercent($user->getTotal(), $cust->getTotal()),
            "user" => $user->getPeriods(),
            "customer" => $cust->getPeriods()
        ];

        return json_encode($response);
    }
}