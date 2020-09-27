<?php

namespace App\Jobs;

use App\Model\Gtfs\Stop as StaticStop;
use App\Model\Gtfs\StopTime;
use App\Model\Gtfs\Trip;
use App\Model\Sight;
use FelixINX\TransitRealtime\FeedMessage;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class ProcessTripUpdate implements ShouldQueue
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
        if (App::environment('local')) {
            $response = $client->get('https://extras.transittracker.ca/storage/tu.pb');
//            $response = $client->get('http://stm-school-industrial-catcher.test/storage/test.pb');
        } else {
            $response = $client->request('POST', 'https://api.stm.info/pub/od/gtfs-rt/ic/v1/tripUpdates', [
                'headers' => [
                    'apikey' => env('STM_APIKEY')
                ]
            ]);
            Storage::put('public/tu.pb', (string) $response->getBody());
        }

        // Convert protobuf
        $feed = new FeedMessage();
        $feed->mergeFromString((string) $response->getBody());

        // Get each entity
        foreach ($feed->getEntity() as $entity) {
            // Keep only entity with E or I
            $routeId = $entity->getTripUpdate()->getTrip()->getRouteId();
            if (strpos($routeId, 'E') !== false or strpos($routeId, 'I') !== false) {
                // Search if existing trip, create it if needed
                $trip = Trip::firstOrCreate(
                    ['trip_id' => $entity->getId()],
                    [
                        'gtfs_route_id' => $routeId,
                        'trip_headsign' => 'TBD',
                        'note_en' => $entity->getTripUpdate()->getTrip()->getStartTime(),
                    ]
                );
                $trip->touch();

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

                    // Check if stops exists
                    $stop = StaticStop::firstOrCreate(
                        ['stop_id' => $item->getStopId()],
                        [
                            'stop_code' => $item->getStopId(),
                            'stop_name' => 'TBD',
                            'stop_lat' => 0,
                            'stop_lon' => 0,
                            'is_fake' => true,
                        ]
                    );

                    // Create a GTFS Stop Time
                    $stopTime = StopTime::firstOrCreate(
                        [
                            'trip_id' => $entity->getId(),
                            'stop_id' => $item->getStopId(),
                        ],
                        [
                            'arrival_time' => $arrivalTime,
                            'departure_time' => $departureTime,
                            'stop_sequence' => $item->getStopSequence(),
                            'schedule_relationship' => $scheduleRelationship,
                        ]
                    );
                }

                // Create the sight
                $sight = Sight::updateOrCreate(
                    ['trip_id' => $trip->id],
                    [
                        strtolower(date('l')) => true
                    ]
                );
                $trip->sight_id = $sight->id;
                $trip->save();
            }
        }

        // Clear the client
        $client = null;
    }
}
