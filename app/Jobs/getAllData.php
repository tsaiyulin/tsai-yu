<?php

namespace blog\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Ixudra\Curl\Facades\Curl;
use blog\Services\totalDataServices;

class GetAllData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 120;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $argStart;
    protected $argEnd;
    protected $argFrom;
    protected $totalDataServices;
    public function __construct($argStart, $argEnd, $argFrom)
    {
        $this->argStart = $argStart;
        $this->argEnd = $argEnd;
        $this->argFrom = $argFrom;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(totalDataServices $totalDataServices)
    {
        $response = $totalDataServices->getData($this->argStart, $this->argFrom);
        $responseArray = json_decode($response, true);
        $allData = $responseArray['hits']['hits'];
        if (empty($allData)) {
            return;
        }
        $insertOriginData = $totalDataServices->insertOriginData($allData);
        if (!empty($insertOriginData)) {
            $insertNewData = $totalDataServices->insertNewData($allData);
        }
        if ($this->argFrom == 0 && $this->argFrom < $responseArray['hits']['total']) {
            for ($this->argFrom = 10000; $this->argFrom < $responseArray['hits']['total']; $this->argFrom += 10000) {
                $job = (new getAllData($this->argStart, $this->argEnd, $this->argFrom, $this->argMethod));
                dispatch($job);
            }
        }
    }
}
