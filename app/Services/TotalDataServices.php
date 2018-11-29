<?php

namespace blog\Services;

use Ixudra\Curl\Facades\Curl;

class TotalDataServices
{
    public function getData($argStart, $argEnd, $argFrom)
    {
        $response = Curl::to("http://train.rd6?start=" . $argStart . "&end=" . $argEnd . "&from=" . $argFrom)->get();
        $responsearray = json_decode($response, true);
        $totalData = $responsearray['hits']['total'];
        return $totalData;
    }
}
