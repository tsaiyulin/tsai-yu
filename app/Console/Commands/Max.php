<?php

namespace blog\Console\Commands;

use Illuminate\Console\Command;
use File;
use Ixudra\Curl\Facades\Curl;
use Artisan;
use blog\newdata;
use blog\data;

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
        $argTable = $this->argument('table');
        $argCol = $this->argument('col');
        $argNum = $this->argument('num');
        if ($argTable == 'data') {
            $maxData = data::all()->sortByDesc($argCol)->take($argNum);
            echo "<pre>";
            print_r($maxData);
        } else if($argTable == 'newdata') {
            $maxData = newdata::all()->sortByDesc($argCol)->take($argNum);
            echo "<pre>";
            print_r($maxData);
        } else {
            print_r('error');
        }
    }
}
