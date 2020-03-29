<?php

namespace App\Jobs;

use League\Csv\Reader;
use App\Model\GTFS\Stop;
use Illuminate\Support\Facades\Http;

class ProcessStopFile extends Job
{
    private $stopFileUrl;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 180;

    /**
     * Create a new job instance.
     *
     * @param string $stopFileUrl
     */
    public function __construct($stopFileUrl)
    {
        $this->stopFileUrl = $stopFileUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \League\Csv\Exception
     */
    public function handle()
    {
        $response = Http::get($this->stopFileUrl);

        $csv = Reader::createFromString($response->body())->setHeaderOffset(0);
        $csvStops = $csv->getRecords();

        foreach ($csvStops as $csvStop) {
            $stop = Stop::firstWhere('stop_id', $csvStop['stop_id']);

            if (!$stop) {
                var_dump('skip #' . $csvStop['stop_id']);
                continue;
            }

            var_dump('update #' . $csvStop['stop_id']);

            $stop->update([
                'stop_code' => $csvStop['stop_code'],
                'stop_name' => $csvStop['stop_name'],
                'stop_lat' => $csvStop['stop_lat'],
                'stop_lon' => $csvStop['stop_lon'],
                'stop_url' => $csvStop['stop_url'],
                'location_type' => $csvStop['location_type'],
                'parent_station' => $csvStop['parent_station'],
                'wheelchair_boarding' => $csvStop['wheelchair_boarding'],
            ]);
        }
    }
}
