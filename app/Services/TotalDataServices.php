<?php

namespace blog\Services;

use Ixudra\Curl\Facades\Curl;
use blog\Repositories\newDataRepository;
use blog\Repositories\dataRepository;

class TotalDataServices
{
    protected $newDataRepository;
    protected $dataRepository;
    protected $argStart;
    protected $argEnd;
    protected $argFrom;
    public function __construct(dataRepository $dataRepository, newDataRepository $newDataRepository)
    {
        $this->dataRepository = $dataRepository;
        $this->newDataRepository = $newDataRepository;
    }
    public function getData($argStart, $argFrom)
    {
        $argEnd = clone $argStart;
        $argEnd->add(new \DateInterval('PT1M'));
        $response = Curl::to("http://train.rd6?start=" . $argStart->format('Y-m-d\TH:i:s') . "&end=" . $argEnd->format('Y-m-d\TH:i:s') . "&from=" . $argFrom)->get();
        return $response;
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
