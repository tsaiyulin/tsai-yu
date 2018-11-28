<?php

namespace blog\Repositories;

use blog\newdata;

class newdataRepository
{
    protected $newdata;

    public function __construct(newdata $newdata)
    {
        $this->newdata = $newdata;
    }

    /**
     * @return Collection
     */
    public function insert($alldata)
    {
        return $this->newdata::updateOrCreate(
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
                'datetime' => $alldata['_source']['@timestamp'],
                'sort' => $alldata['sort'][0],
            ]
        );

    }
}