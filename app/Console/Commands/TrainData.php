<?php

namespace blog\Console\Commands;

use Illuminate\Console\Command;
use File;
use blog\Services\TotalDataServices;
use blog\Services\JobServices;

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
    protected $totalData;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(TotalDataServices $TotalDataServices, JobServices $JobServices)
    {
        parent::__construct();
        $this->TotalDataServices = $TotalDataServices;
        $this->JobServices = $JobServices;
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
        $totalDataNum = $this->TotalDataServices->getData($argStart, $argEnd, $argFrom);
        $callJob = $this->JobServices->callJob($argStart, $argEnd, $argFrom, $totalDataNum, $argMethod);
    }
}
