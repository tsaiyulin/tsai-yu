<?php

namespace blog\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Ixudra\Curl\Facades\Curl;
use Artisan;
use blog\Services\totalDataServices;

class getdata implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $argStart;
    protected $argEnd;
    protected $argFrom;
    protected $argMethod;

    public function __construct($argStart, $argEnd, $argFrom, $argMethod)
    {
        $this->argStart = $argStart;
        $this->argEnd = $argEnd;
        $this->argFrom = $argFrom;
        $this->argMethod = $argMethod;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    protected $TotalDataServices;
    public function handle(totalDataServices $totalDataServices)
    {
        $this->totalDataServices = $totalDataServices;
        $response = Curl::to("http://train.rd6?start=" . $this->argStart . "&end=" . $this->argEnd . "&from=" . $this->argFrom)->get();
        $responsearray = json_decode($response, true);
        $allData = $responsearray['hits']['hits'];
        if ($this->argMethod == 'insert') {
            $response = $this->totalDataServices->insertOriginData($allData);
        } else if ($this->argMethod == 'newdatainsert') {
            $response = $this->totalDataServices->insertNewData($allData);
        } else {
            $response = $allData;
        }
        return $response;
    }
    public function failed(Exception $exception)
    {
        // Send user notification of failure, etc...
    }
}
