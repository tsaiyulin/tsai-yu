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
    protected $signature = 'gettraindata {--s|start= : format: 2017-01-01T00:00:00}{--e|end= : format: 2017-01-01T00:00:59 :format: 2017-01-01T00:00:59}{--f|from=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '取train.rd6資料';
    protected $totalDataServices;
    protected $argStart;
    protected $argEnd;
    protected $argFrom;

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
        $this->getOpt();
        while($this->argStart <= $this->argEnd) {
            $job = new getAllData($this->argStart, $this->argEnd, $this->argFrom);
            dispatch($job);
            // startTime增加一分鐘
            $this->argStart->add(new \DateInterval('PT1M'));
        }
    }
    public function getOpt()
    {
        $argStart = $this->option('start');
        $argEnd = $this->option('end');
        $argFrom = $this->option('from');

        $this->argStart = new \DateTime($argStart, new \DateTimeZone('Etc/GMT+4'));
        $this->argEnd = new \DateTime($argEnd, new \DateTimeZone('Etc/GMT+4'));
        $this->argFrom = $argFrom;

        // 沒指定時間，預設為 4 分鐘前
        if (empty($argStart)) {
            $this->argStart = new \DateTime('4 minutes ago', new \DateTimeZone('Asia/Taipei'));
            $this->argStart->setTime($this->argStart->format('H'), $this->argStart->format('i'), 0);
            $this->argStart->format('Y-m-d\TH:i:s');
        }
        if (empty($argEnd)) {
            $this->argEnd = clone $this->argStart;
            $this->argEnd->setTime($this->argStart->format('H'), $this->argStart->format('i'), 59);
            $this->argEnd->format('Y-m-d\TH:i:s');
        }
    }
}
