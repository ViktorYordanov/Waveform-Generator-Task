<?php
require 'vendor/autoload.php';

use App\Analyzer;
use App\Reader;
use App\Response;
use App\TimePeriods;

header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD'])
{
    case 'POST':
        if (isset($_FILES['user_channel']) && !empty($_FILES['user_channel']['tmp_name']) && isset($_FILES['customer_channel']) && !empty($_FILES['customer_channel']['tmp_name'])) {
            $userChannelReader = new Reader('user', $_FILES['user_channel']['tmp_name']);
            $customerChannelReader = new Reader('customer', $_FILES['customer_channel']['tmp_name']);
            $userTimePeriods = new TimePeriods();
            $customerTimePeriods = new TimePeriods();
            $userChannelReader->extractPeriods($userTimePeriods);
            $customerChannelReader->extractPeriods($customerTimePeriods);

            $analizer = new Analyzer();
            $response = new Response($analizer);
            echo $response->generateJson($userTimePeriods, $customerTimePeriods);
        }
        else {
            http_response_code(406);
            echo json_encode(
                ['message' => 'You must provide BOTH "user_channel" and "customer_channel" files!']
            );
        }
                    
        break;
    
    default:
        echo json_encode(
            ['message' => 'Send POST request to the same endpoint containing "user_channel" and "customer_channel" files.']
        );
        break;
}