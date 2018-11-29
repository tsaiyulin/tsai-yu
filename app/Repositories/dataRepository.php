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
    public function insertOrigindata($alldata)
    {
        foreach ($alldata as $eachdata) {
            $this->data::updateOrCreate(
                [
                    '_id' => $eachdata['_id']
                ],[
                    '_index' => $eachdata['_index'],
                    '_type' => $eachdata['_type'],
                    '_id' => $eachdata['_id'],
                    '_score' => $eachdata['_score'],
                    'server_name' => $eachdata['_source']['server_name'],
                    'remote' => $eachdata['_source']['remote'],
                    'route' => $eachdata['_source']['route'],
                    'route_path' => $eachdata['_source']['route_path'],
                    'request_method' => $eachdata['_source']['request_method'],
                    'user' => $eachdata['_source']['user'],
                    'http_args' => $eachdata['_source']['http_args'],
                    'log_id' => $eachdata['_source']['log_id'],
                    'status' => $eachdata['_source']['status'],
                    'size' => $eachdata['_source']['size'],
                    'referer' => $eachdata['_source']['referer'],
                    'user_agent' => $eachdata['_source']['user_agent'],
                    'timestamp' => $eachdata['_source']['@timestamp'],
                    'sort' => $eachdata['sort'][0],
                ]
            );
        }
    }
    public function getMaxData($argCol, $argNum)
    {
        return $this->data::all()->sortByDesc($argCol)->take($argNum);
    }
}