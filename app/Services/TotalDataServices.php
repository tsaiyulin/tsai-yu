<?php

namespace blog\Services;

use Ixudra\Curl\Facades\Curl;
use blog\Repositories\newdataRepository;
use blog\Repositories\dataRepository;

class TotalDataServices
{
    protected $newdataRepository;
    protected $dataRepository;
    public function __construct(dataRepository $dataRepository, newdataRepository $newdataRepository)
    {
        $this->dataRepository = $dataRepository;
        $this->newdataRepository = $newdataRepository;
    }
    public function getData($argStart, $argEnd, $argFrom)
    {
        $response = Curl::to("http://train.rd6?start=" . $argStart . "&end=" . $argEnd . "&from=" . $argFrom)->get();
        $responsearray = json_decode($response, true);
        $totalData = $responsearray['hits']['total'];
        return $totalData;
    }
    public function insertOriginData($allData)
    {
        $response = $this->dataRepository->insertOrigindata($allData);
    }
    public function insertNewData($allData)
    {
        $response = $this->newdataRepository->insertNewData($allData);
    }
}
