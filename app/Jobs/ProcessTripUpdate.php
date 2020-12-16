<?php

namespace App\Jobs;

use App\Models\Gtfs\Calendar;
use App\Models\Gtfs\Route;
use App\Models\Gtfs\Stop as StaticStop;
use App\Models\Gtfs\StopTime;
use App\Models\Gtfs\Trip;
use App\Models\Period;
use App\Models\Sight;
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
            $response = $client->get('http://stm-school-industrial-catcher.test/storage/test.pb');
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
            $routeId = $entity->getTripUpdate()->getTrip()->getRouteId();
            $routeType = null;
            if (strpos($routeId, 'E')) {
                $routeType = 'E';
            } else if (strpos($routeId, 'I')) {
                $routeType = 'I';
            }

            // Keep only entity with E or I
            if ($routeType) {
                // Create the route if it dosen't exist
                Route::firstOrCreate(
                    ['route_id' => $routeId],
                    [
                        'agency_id' => 'STM',
                        'route_short_name' => $routeId,
                        'route_long_name' => $routeType === 'E' ? 'Ecole' : 'Industriel',
                        'route_color' => $routeType === 'E' ? '#3b9b74' : '#f7e200',
                        'route_text_color' => $routeType === 'E' ? '#ffffff' : '#000000',
                    ]
                );


                // Search if existing trip, create it if needed
                $trip = Trip::updateOrCreate(
                    ['trip_id' => $entity->getId()],
                    [
                        'route_id' => $routeId,
                        'trip_headsign' => 'TBD «» TBD',
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
                    StaticStop::firstOrCreate(
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
                    StopTime::firstOrCreate(
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
                    ['trip_id' => $trip->trip_id],
                    [
                        strtolower(date('l')) => true
                    ]
                );

                // Get service
                $service = Calendar::firstOrCreate(
                    [ 'service_id' => "{$this->getPeriod()->period}-EXTRAS{$routeType}-{$sight->service_pattern}"],
                    [
                        'monday' => $sight->monday,
                        'tuesday' => $sight->tuesday,
                        'wednesday' => $sight->wednesday,
                        'thursday' => $sight->thursday,
                        'friday' => $sight->friday,
                        'saturday' => $sight->saturday,
                        'sunday' => $sight->sunday,
                        'start_date' => $this->getPeriod()->start_date,
                        'end_date' => $this->getPeriod()->end_date,
                    ]
                );
                $trip->service_id = $service->service_id;

                $trip->save();
            }
        }

        // Clear the client
        $client = null;
    }

    private function getPeriod ()
    {
        return Period::whereDate('start_date', '<=', today())->whereDate('end_date', '>=', today())->first();
    }
}
