<?php

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

require 'constants.php';

class ApiTest extends TestCase
{
    private $http;

    public function setUp(): void
    {
        $this->http = new Client(['base_uri' => BASE_URL, 'exceptions' => false]);
    }

    public function tearDown(): void
    {
        $this->http = null;
    }

    public function testGet(): void
    {
        $response = $this->http->request('GET', BASE_URL);

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }

    public function test_response_error_when_missing_file()
    {
        try {
            // it should break because we are not sending files
            $response = $this->http->request('POST', BASE_URL);
        }
        catch (ClientException $e) {
            $this->assertEquals(406, $e->getCode());
        }
    }
}