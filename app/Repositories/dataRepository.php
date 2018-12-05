<?php

namespace blog\Repositories;

use blog\data;

class DataRepository
{
    /** @var data 注入的data model */
    protected $data;

    /**
     * dataRepository constructor.
     * @param data $data
     */
    public function __construct(data $data)
    {
        $this->data = $data;
    }

    /**
     * @return Collection
     */
    public function insertOriginData($allData)
    {
        foreach ($allData as $eachData) {
            $this->data::updateOrCreate(
                [
                    '_id' => $eachData['_id']
                ],[
                    '_index' => $eachData['_index'],
                    '_type' => $eachData['_type'],
                    '_score' => $eachData['_score'],
                    'server_name' => $eachData['_source']['server_name'],
                    'remote' => $eachData['_source']['remote'],
                    'route' => $eachData['_source']['route'],
                    'route_path' => $eachData['_source']['route_path'],
                    'request_method' => $eachData['_source']['request_method'],
                    'user' => $eachData['_source']['user'],
                    'http_args' => $eachData['_source']['http_args'],
                    'log_id' => $eachData['_source']['log_id'],
                    'status' => $eachData['_source']['status'],
                    'size' => $eachData['_source']['size'],
                    'referer' => $eachData['_source']['referer'],
                    'user_agent' => $eachData['_source']['user_agent'],
                    'datetime' => $eachData['_source']['@timestamp'],
                    'sort' => $eachData['sort'][0],
                ]
            );
            $processedData[] = $eachData;
        }
        return $processedData;
    }
    public function getMaxData($argCol, $argNum)
    {
        return $this->data::all()->sortByDesc($argCol)->take($argNum);
    }
}