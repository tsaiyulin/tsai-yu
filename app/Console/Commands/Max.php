<?php

namespace blog\Console\Commands;

use Illuminate\Console\Command;
use File;
use Ixudra\Curl\Facades\Curl;
use Artisan;
use blog\newdata;
use blog\data;
use blog\Repositories\newdataRepository;
use blog\Repositories\dataRepository;

class Max extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Max {table}{col}{num}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '取出最大值';
    protected $dataRepository;
    protected $newdataRepository;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(newdataRepository $newdataRepository, dataRepository $dataRepository)
    {
        parent::__construct();
        $this->dataRepository = $dataRepository;
        $this->newdataRepository = $newdataRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $argTable = $this->argument('table');
        $argCol = $this->argument('col');
        $argNum = $this->argument('num');
        if ($argTable == 'data') {
            $maxData = $this->dataRepository->getMaxData($argCol, $argNum);
        } else if($argTable == 'newdata') {
            $maxData = $this->newdataRepository->getMaxData($argCol, $argNum);
        } else {
            $maxData = 'error';
        }
        return $maxData;
    }
}
