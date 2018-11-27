<?php
namespace blog\Http\Controllers;

use blog\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use blog\data;
use blog\newdata;
// use Carbon\Carbon;
use Artisan;

class test extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCURL()
    {

        // $response = Curl::to('http://train.rd6?start=2018-11-23T10:11:11&end=2018-11-23T10:12:00&from=0')
        // ->get();
        Artisan::call('getCURL', array('http' => 'http://train.rd6', 'start' => '2018-11-23T10:11:11', 'end' => '2018-11-23T10:12:00', 'from' => '0'));
        // Artisan::call('getCURL', array('http' => 'http://train.rd6', 'start' => '2018-11-23T10:11:11', 'end' => '2018-11-23T10:12:00', 'from' => '0'));
        // Artisan::call('insertorigindata');

        // $array = json_decode($response, true);
        // $alldata = ($array['hits']['hits']);
        // return($alldata);
    }
    public function insertdata()
    {
        $alldata = $this->getCURL();
        foreach ($alldata as $value) {
            $insert = data::insert(
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
                'datetime' => $value['_source']['@timestamp'],
                'sort' => $value['sort'][0],
            ]);
        }
    }
    public function modifydata()
    {
        $alldata = $this->getCURL();
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