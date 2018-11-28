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
    public function insertOrigindata($allData)
    {
        return $this->data::updateOrCreate(
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
                'timestamp' => $allData['_source']['@timestamp'],
                'sort' => $allData['sort'][0],
            ]
        );
    }
}