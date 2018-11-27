<?php

namespace blog\Console\Commands;

use Illuminate\Console\Command;
use File;
use Ixudra\Curl\Facades\Curl;
use Artisan;
use blog\newdata;

class insertnewdata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insertnewdata {alldata}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新增更改資料到db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $alldata = $this->argument('alldata');
        foreach ($alldata as $value) {
            $day = substr( $value['_source']['@timestamp'] , 0 , 10 );
            $time = substr( $value['_source']['@timestamp'] , 11 , 8 );
            $datetime = $day." ".$time;
            $insertnewdata = newdata::insert(
            [
                '_index' => $value['_index'],
                '_type' => $value['_type'],
                '_id' => $value['_id'],
                '_score' => $value['_score'],
                'server_name' => $value['_source']['server_name'],
                'remote' => $value['_source']['remote'],
                'route' => $value['_source']['route'],
                'route_path' => $value['_source']['route_path'],
                'request_method' => $value['_source']['request_method'],
                'user' => $value['_source']['user'],
                'http_args' => $value['_source']['http_args'],
                'log_id' => $value['_source']['log_id'],
                'status' => $value['_source']['status'],
                'size' => $value['_source']['size'],
                'referer' => $value['_source']['referer'],
                'user_agent' => $value['_source']['user_agent'],
                'datetime' => $datetime,
                'sort' => $value['sort'][0],
            ]);
        }
    }
}
