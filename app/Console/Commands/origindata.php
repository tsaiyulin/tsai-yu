<?php

namespace blog\Console\Commands;

use Illuminate\Console\Command;
use File;
use Ixudra\Curl\Facades\Curl;
use Artisan;
use blog\data;
use blog\Repositories\dataRepository;

class Origindata extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insertorigindata {alldata}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新增原始資料到db';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $dataRepository;

    public function __construct(dataRepository $dataRepository)
    {
        parent::__construct();
        $this->dataRepository = $dataRepository;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $allData = $this->argument('alldata');
        foreach ($allData as $data) {
            $insert = $this->dataRepository->insertOrigindata($data);
        }
    }
}
