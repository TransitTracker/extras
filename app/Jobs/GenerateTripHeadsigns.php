<?php

namespace App\Jobs;

use App\Models\Gtfs\Stop;
use App\Models\Gtfs\StopTime;
use App\Models\Gtfs\Trip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateTripHeadsigns implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (Trip::all() as $trip) {
            $times = StopTime::where('trip_id', $trip->trip_id)->orderBy('stop_sequence', 'ASC')->select('id', 'stop_id')->get();

            $firstStop = Stop::find($times->first()->stop_id)->stop_name;
            $lastStop = Stop::find($times->last()->stop_id)->stop_name;

            $trip->trip_headsign = "{$firstStop} «» {$lastStop}";
            $trip->save();
        }
    }
}
