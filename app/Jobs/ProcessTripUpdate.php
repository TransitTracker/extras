<?php

namespace App\Jobs;

use App\Trip;
use GuzzleHttp\Client;
use FelixINX\TransitRealtime\FeedMessage;

class ProcessTripUpdate extends Job
{
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
        $response = $client->request('POST', 'https://api.stm.info/pub/od/gtfs-rt/ic/v1/tripUpdates', [
            'headers' => [
             'apikey' => env('STM_APIKEY')
            ]
        ]);

        // Convert protobuf
        $feed = new FeedMessage();
        $feed->mergeFromString($response->getBody()->getContents());

        // Get each entity
        foreach ($feed->getEntity() as $entity) {
            // Keep only entity with E or I
            $routeId = $entity->getTripUpdate()->getTrip()->getRouteId();
            if (strpos($routeId, 'E') !== false or strpos($routeId, 'I') !== false) {
                // Search if existing trip
                $existingTrip = Trip::where('trip_id', $entity->getId())->first();

                // Create an empty array
                $stopTimeUpdates = [];

                // Get each stop time update
                foreach ($entity->getTripUpdate()->getStopTimeUpdate() as $item) {
                    // Check if each attributes exists
                    switch ($item->getScheduleRelationship()) {
                        case 0:
                            $arrivalTime = date('G:i:s', $item->getArrival()->getTime());
                            $departureTime = date('G:i:s', $item->getDeparture()->getTime());
                            $scheduleRelationship = 'SCHEDULED';
                            break;
                        case 1:
                            $arrivalTime = date('G:i:s', $item->getArrival()->getTime());
                            $departureTime = date('G:i:s', $item->getDeparture()->getTime());
                            $scheduleRelationship = 'SKIPPED';
                            break;
                        case 2:
                            $arrivalTime = '';
                            $departureTime = '';
                            $scheduleRelationship = 'NO_DATA';
                            break;
                    }

                    // Build the object and add it to stopTimeUpdates array
                    $newUpdate = (object) [
                        'stop_sequence' => $item->getStopSequence(),
                        'arrival_time' => $arrivalTime,
                        'departure_time' => $departureTime,
                        'stop_id' => $item->getStopId(),
                        'schedule_relationship' => $scheduleRelationship
                    ];
                    array_push($stopTimeUpdates, $newUpdate);
                }

                // Compare stop time updates length (if existing trip)
                if ($existingTrip) {
                    if (count($existingTrip->stop_time_updates) > count($stopTimeUpdates)) {
                        $stopTimeUpdates = $existingTrip->stop_time_updates;
                    }
                }

                // Create or update the trip
                Trip::updateOrCreate(
                    ['trip_id' => $entity->getId()],
                    [
                        'start_time' => $entity->getTripUpdate()->getTrip()->getStartTime(),
                        'route_id' => $routeId,
                        'stop_time_updates' => $stopTimeUpdates
                    ]
                );
            }
        }

        // Clear the client
        $client = null;
    }
}
