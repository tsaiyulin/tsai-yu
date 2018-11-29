<?php

namespace blog\Services;

use blog\Jobs\getdata;

class JobServices
{
    public function callJob($argStart, $argEnd, $argFrom, $totalData, $argMethod)
    {
        for ($argFrom = 0; $argFrom < $totalData; $argFrom += 10000) {
            $job = new getdata($argStart, $argEnd, $argFrom, $argMethod);
            dispatch($job);
        }
    }
}
