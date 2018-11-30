<?php

namespace blog\Repositories;

use blog\newdata;
use Carbon\Carbon;

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
    public function insertNewData($allData)
    {
        foreach ($allData as $data) {
            $dt = Carbon::createFromFormat('Y-m-d\TH:i:s.uuP', $data['_source']['@timestamp']);
            $datetime = $dt->toDateTimeString();
            $data['_source']['@timestamp'] = $datetime;
            $this->newdata::updateOrCreate(
                [
                    '_id' => $data['_id']
                ],[
                    '_index' => $data['_index'],
                    '_type' => $data['_type'],
                    '_id' => $data['_id'],
                    '_score' => $data['_score'],
                    'server_name' => $data['_source']['server_name'],
                    'remote' => $data['_source']['remote'],
                    'route' => $data['_source']['route'],
                    'route_path' => $data['_source']['route_path'],
                    'request_method' => $data['_source']['request_method'],
                    'user' => $data['_source']['user'],
                    'http_args' => $data['_source']['http_args'],
                    'log_id' => $data['_source']['log_id'],
                    'status' => $data['_source']['status'],
                    'size' => $data['_source']['size'],
                    'referer' => $data['_source']['referer'],
                    'user_agent' => $data['_source']['user_agent'],
                    'datetime' => $data['_source']['@timestamp'],
                    'sort' => $data['sort'][0],
                ]
            );
        }
    }
    public function getMaxData($argCol, $argNum)
    {
        return $this->newdata::all()->sortByDesc($argCol)->take($argNum);
    }
}