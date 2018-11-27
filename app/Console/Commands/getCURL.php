<?php

namespace blog\Console\Commands;

use Illuminate\Console\Command;
use File;
use Ixudra\Curl\Facades\Curl;
use Artisan;

class getCURL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getCURL {http}{start}{end}{from}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '取CURL資料';

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
        $arghttp = $this->argument('http');
        $argstart = $this->argument('start');
        $argend = $this->argument('end');
        $argfrom = $this->argument('from');
        $response = Curl::to($arghttp."?start=".$argstart."&end=".$argend."&from=".$argfrom)->get();
        $array = json_decode($response, true);
        $alldata = ($array['hits']['hits']);
        Artisan::call('insertorigindata', array('alldata' => $alldata));
    }
}
