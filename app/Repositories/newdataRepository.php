<?php

namespace blog\Repositories;

use blog\newdata;

class NewdataRepository
{
    protected $newdata;

    public function __construct(newdata $newdata)
    {
        $this->newdata = $newdata;
    }

    /**
     * @return Collection
     */
    public function insert($allData)
    {
        return $this->newdata::updateOrCreate(
            [
                '_id' => $allData['_id']
            ],[
                '_index' => $allData['_index'],
                '_type' => $allData['_type'],
                '_id' => $allData['_id'],
                '_score' => $allData['_score'],
                'server_name' => $allData['_source']['server_name'],
                'remote' => $allData['_source']['remote'],
                'route' => $allData['_source']['route'],
                'route_path' => $allData['_source']['route_path'],
                'request_method' => $allData['_source']['request_method'],
                'user' => $allData['_source']['user'],
                'http_args' => $allData['_source']['http_args'],
                'log_id' => $allData['_source']['log_id'],
                'status' => $allData['_source']['status'],
                'size' => $allData['_source']['size'],
                'referer' => $allData['_source']['referer'],
                'user_agent' => $allData['_source']['user_agent'],
                'datetime' => $allData['_source']['@timestamp'],
                'sort' => $allData['sort'][0],
            ]
        );
    }
    public function getMaxData($argCol, $argNum)
    {
        return $this->newdata::all()->sortByDesc($argCol)->take($argNum);
    }
}