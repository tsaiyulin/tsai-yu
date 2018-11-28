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
        $argtable = $this->argument('table');
        $argcol = $this->argument('col');
        $argnum = $this->argument('num');
        if ($argtable == 'data') {
            $maxdata = data::all()->sortByDesc($argcol)->take($argnum);
            echo "<pre>";
            print_r($maxdata);
        } else if($argtable == 'newdata') {
            $maxdata = newdata::all()->sortByDesc($argcol)->take($argnum);
            echo "<pre>";
            print_r($maxdata);
        } else {
            print_r('error');
        }
    }
}
