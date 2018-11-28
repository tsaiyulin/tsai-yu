<?php

namespace blog\Console\Commands;

use Illuminate\Console\Command;
use File;
use Ixudra\Curl\Facades\Curl;
use Artisan;
use blog\newdata;
use Carbon\Carbon;

class getCURL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gettraindata {start}{end}{from}{--method=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '取train.rd6資料';

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
        $argstart = $this->argument('start');
        $argend = $this->argument('end');
        $argfrom = $this->argument('from');
        $argmethod = $this->option('method');
        $response = Curl::to("http://train.rd6?start=".$argstart."&end=".$argend."&from=".$argfrom)->get();
            $array = json_decode($response, true);
            $totaldata = ($array['hits']['total']);

        for ($argfrom = 0; $argfrom < $totaldata; $argfrom+=10000) {
            $response = Curl::to("http://train.rd6?start=".$argstart."&end=".$argend."&from=".$argfrom)->get();
            $array = json_decode($response, true);
            $alldata = $array['hits']['hits'];

            if ($argmethod == 'insert') {
                Artisan::call('insertorigindata', array('alldata' => $alldata));
            } else if ($argmethod == 'newdatainsert') {
                Artisan::call('insertnewdata', array('alldata' => $alldata));
            } else {
                echo "<pre>";
                // print_r($alldata);
                // foreach ($alldata as $value) {
                $dt = Carbon::createFromFormat('Y-m-d\TH:i:s.uuP', '2018-11-23T10:11:11.000000000+08:00');
                // $a = '2018-11-23T10:11:11.000000000+08:00'->toDateTimeString();
                $datetime = $dt -> toDateTimeString();
                print_r($datetime);
                exit;
            // }
            }
        }
        // $response = Curl::to("http://train.rd6?start=".$argstart."&end=".$argend."&from=".$argfrom)->get();
        // $array = json_decode($response, true);
        // echo "<pre>";
        // print_r($array);
        // exit;
        // $alldata = ($array['hits']['hits']);
        // if ($argmethod == 'insert') {
        //     Artisan::call('insertorigindata', array('alldata' => $alldata));
        // } else if ($argmethod == 'newdatainsert') {
        //     Artisan::call('insertnewdata', array('alldata' => $alldata));
        // } else {
        //     echo "<pre>";
        //     print_r($alldata);
        // }
    }
}
