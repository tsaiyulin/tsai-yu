<?php

namespace blog\Console\Commands;

use Illuminate\Console\Command;
use File;
use Ixudra\Curl\Facades\Curl;
use Artisan;
use blog\newdata;
use Carbon\Carbon;
use blog\Jobs\getdata;

class TrainData extends Command
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
        $argStart = $this->argument('start');
        $argEnd = $this->argument('end');
        $argFrom = $this->argument('from');
        $argMethod = $this->option('method');
        $response = Curl::to("http://train.rd6?start=" . $argStart . "&end=" . $argEnd . "&from=" . $argFrom)->get();
        $responsearray = json_decode($response, true);
        $totalData = $responsearray['hits']['total'];
        for ($argFrom = 0; $argFrom < $totalData; $argFrom += 10000) {
            $job = new getdata($argStart, $argEnd, $argFrom, $argMethod);
            dispatch($job);
        }
    }
}
