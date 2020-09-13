<?php

namespace App\Jobs;

use App\Model\Gtfs\Stop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use League\Csv\Reader;

class ProcessStopFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
    public function __construct(string $stopFileUrl)
    {
        $this->stopFileUrl = $stopFileUrl;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::get($this->stopFileUrl);

        $csv = Reader::createFromString($response->body())->setHeaderOffset(0);
        $csvStops = $csv->getRecords();

        foreach ($csvStops as $csvStop) {
            Stop::updateOrCreate(
                ['stop_id' => $csvStop['stop_id']],
                [
                    'stop_code' => $csvStop['stop_code'],
                    'stop_name' => $csvStop['stop_name'],
                    'stop_lat' => $csvStop['stop_lat'],
                    'stop_lon' => $csvStop['stop_lon'],
                    'stop_url' => $csvStop['stop_url'],
                    'location_type' => $csvStop['location_type'],
                    'parent_station' => $csvStop['parent_station'],
                    'wheelchair_boarding' => $csvStop['wheelchair_boarding'],
                    'is_fake' => false,
                ]
            );
        }
    }
}
