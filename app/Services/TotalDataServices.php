<?php

namespace blog\Services;

use Ixudra\Curl\Facades\Curl;
use blog\Repositories\newDataRepository;
use blog\Repositories\dataRepository;

class TotalDataServices
{
    protected $newDataRepository;
    protected $dataRepository;
    public function __construct(dataRepository $dataRepository, newDataRepository $newDataRepository)
    {
        $this->dataRepository = $dataRepository;
        $this->newDataRepository = $newDataRepository;
    }
    public function getDataNum($argStart, $argEnd, $argFrom)
    {
        $response = Curl::to("http://train.rd6?start=" . $argStart . "&end=" . $argEnd . "&from=" . $argFrom)->get();
        $responsearray = json_decode($response, true);
        $totalDataNum = $responsearray['hits']['total'];
        return $totalDataNum;
    }
    public function insertOriginData($allData)
    {
        $response = $this->dataRepository->insertOriginData($allData);
    }
    public function insertNewData($allData)
    {
        $response = $this->newDataRepository->insertNewData($allData);
    }
}
