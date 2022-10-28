<?php

namespace App;

use mysqli;

class Reader
{
    /**
     * name of the channel (user/customer)
     */
    protected $channel;

    /**
     * File location
     */
    protected $file;

    public function __construct(string $channel, string $file)
    {
        $this->channel = $channel;
        $this->file = $file;
    }

    public function getContent(): array
    {
        $content = [];
        $handle = fopen($this->file, 'r');
        while (($row = fgets($handle)) !== false)
        {
            $content[] = $row;
        }

        return $content;
    }

    public function extractPeriods(TimePeriods $periods): void
    {
        // Assuming the person started talking at 0s
        $start = 0;

        $content = $this->getContent();

        foreach ($content as $data)
        {
            $matches = [];
            preg_match('/^.*(silence_end|silence_start): ([0-9]+\.*[0-9]*).*$/', $data, $matches);

            if (isset($matches[1]) && isset($matches[2])) {
                if ($matches[1] == 'silence_start') {
                    $end = $matches[2];
                    $periods->addPeriod($start, $end);
                }
                else {
                    $start = $matches[2];
                }
            }
        }
    }
}