<?php

namespace blog\Console\Commands;

use Illuminate\Console\Command;
use File;
use Ixudra\Curl\Facades\Curl;
use Artisan;
use blog\newdata;
use Carbon\Carbon;
use blog\Repositories\newdataRepository;

class NewdataGet extends Command
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
    protected $dataRepository;

    public function __construct(newdataRepository $newdataRepository)
    {
        parent::__construct();
        $this->newdataRepository = $newdataRepository;
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
            $dt = Carbon::createFromFormat('Y-m-d\TH:i:s.uuP', $data['_source']['@timestamp']);
            $datetime = $dt->toDateTimeString();
            $data['_source']['@timestamp'] = $datetime;
            $insertNewdata = $this->newdataRepository->insertNewData($data);
        }
    }
}
