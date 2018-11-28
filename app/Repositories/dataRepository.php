<?php

namespace blog\Repositories;

use blog\data;

class dataRepository
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
    public function insertorigindata($alldata)
    {
        return $this->data::updateOrCreate(
            [
                '_id' => $alldata['_id']
            ],[
                '_index' => $alldata['_index'],
                '_type' => $alldata['_type'],
                '_id' => $alldata['_id'],
                '_score' => $alldata['_score'],
                'server_name' => $alldata['_source']['server_name'],
                'remote' => $alldata['_source']['remote'],
                'route' => $alldata['_source']['route'],
                'route_path' => $alldata['_source']['route_path'],
                'request_method' => $alldata['_source']['request_method'],
                'user' => $alldata['_source']['user'],
                'http_args' => $alldata['_source']['http_args'],
                'log_id' => $alldata['_source']['log_id'],
                'status' => $alldata['_source']['status'],
                'size' => $alldata['_source']['size'],
                'referer' => $alldata['_source']['referer'],
                'user_agent' => $alldata['_source']['user_agent'],
                'timestamp' => $alldata['_source']['@timestamp'],
                'sort' => $alldata['sort'][0],
            ]
        );

    }
}