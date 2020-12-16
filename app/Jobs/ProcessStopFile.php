<?php

namespace App\Jobs;

use App\Models\Gtfs\Stop;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;

class ProcessStopFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 180;

    private $stopFile;

    /**
     * Create a new job instance.
     *
     * @param string $stopFile
     */
    public function __construct(string $stopFile)
    {
        $this->stopFile = $stopFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = Storage::get($this->stopFile);

        $csv = Reader::createFromString($file)->setHeaderOffset(0);
        $csvStops = $csv->getRecords();

        $stops = [];
        foreach ($csvStops as $csvStop) {
            array_push(
                $stops,
                [
                    'stop_id' => $csvStop['stop_id'],
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

        collect($stops)
            ->chunk(2500)
            ->each(function (Collection $chunk) {
                Stop::upsert($chunk->all(), ['stop_id'], []);
            });
    }
}
