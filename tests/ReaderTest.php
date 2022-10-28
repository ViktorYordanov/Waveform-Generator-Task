<?php

use App\Reader;
use App\TimePeriods;
use PHPUnit\Framework\TestCase;

class ReaderTest extends TestCase
{
    private $userChannelReader;
    private $customerChannelReader;

    public function setUp(): void
    {
        $this->userChannelReader = new Reader('user', 'tests/resources/user-channel.txt');
        $this->customerChannelReader = new Reader('customer', 'tests/resources/customer-channel.txt');
    }

    /**
     * @test
     */
    public function reading_not_extisting_file(): void
    {
        $nonExistantFileReader = new Reader('user', 'there/is/no/such/file.txt');
        $this->expectWarning();
        $userChannelContent = $nonExistantFileReader->getContent();
    }

    /**
     * @test
     */
    public function extracting_time_periods(): void
    {
        $userTimePeriods = new TimePeriods();
        
        $this->userChannelReader->extractPeriods($userTimePeriods);

        $wavedata = json_decode(file_get_contents('tests/resources/wavedata.json'));
        $expected = $wavedata->talkTimes->user;

        $this->assertEquals($expected, $userTimePeriods->getPeriods());
    }
}