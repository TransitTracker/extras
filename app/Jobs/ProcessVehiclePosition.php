<?php

namespace App\Jobs;

use App\Model\Trip;
use FelixINX\TransitRealtime\FeedMessage;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessVehiclePosition implements ShouldQueue
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
        // Get the PB file
        $client = new Client();
        $response = $client->get('https://v1.transittracker.ca/data/raw/stm-vehiclePosition.pb');

        // Convert protobuf
        $feed = new FeedMessage();
        $feed->mergeFromString($response->getBody()->getContents());

        // Get each entity
        foreach ($feed->getEntity() as $entity) {
            // Check if this trip has been recorded before
            $trip = Trip::firstWhere('trip_id', $entity->getVehicle()->getTrip()->getTripId());
            if (!$trip) {
                continue;
            }

            // Check if the stop sequence exists in the stop time updates
            $stopTimeUpdates = $trip->stop_time_updates;
            $stopTimeUpdate = collect($stopTimeUpdates)->firstWhere('stop_sequence', $entity->getVehicle()->getCurrentStopSequence());
            if (!$stopTimeUpdate) {
                continue;
            }

            // Update the field to add the vehicle position
            $stopTimeUpdate['lat'] = $entity->getVehicle()->getPosition()->getLatitude();
            $stopTimeUpdate['lon'] = $entity->getVehicle()->getPosition()->getLongitude();
            $stopTimeUpdates[$stopTimeUpdate['stop_sequence']] = $stopTimeUpdate;
            $trip->save();
        }
    }
}
