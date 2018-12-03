<?php

namespace blog\Console\Commands;

use Illuminate\Console\Command;
use File;
use blog\Services\totalDataServices;
use blog\Jobs\getAllData;

class GetTrainData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gettraindata {start}{end}{from}{--method=insert}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '取train.rd6資料,start:起始時間,end:結束時間,from:從第幾筆資料開始,method:存原始資料(insert)或存更改過的資料(newdatainsert)';
    protected $totalDataServices;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(totalDataServices $totalDataServices)
    {
        parent::__construct();
        $this->totalDataServices = $totalDataServices;
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
        $totalDataNum = $this->totalDataServices->getDataNum($argStart, $argEnd, $argFrom);
        for ($argFrom = 0; $argFrom < $totalDataNum; $argFrom += 10000) {
            $job = new getAllData($argStart, $argEnd, $argFrom, $argMethod);
            dispatch($job);
        }
    }
}
