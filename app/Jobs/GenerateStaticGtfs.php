<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Model\Trip as RealtimeTrip;
use App\Model\GTFS\Trip as StaticTrip;
use App\Model\GTFS\Stop as StaticStop;
use App\Model\GTFS\Route as StaticRoute;
use App\Model\GTFS\Calendar as StaticCalendar;
use App\Model\GTFS\Agency as StaticAgency;
use App\Model\GTFS\StopTime as StaticStopTime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateStaticGtfs implements ShouldQueue
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
        StaticCalendar::truncate();
        StaticRoute::truncate();
        StaticStop::truncate();
        StaticStopTime::truncate();
        StaticTrip::truncate();

        // Todo: service
        $serviceEcole = StaticCalendar::firstOrCreate(
            ['service_id' => '20M-ECOLE-00-S'],
            [
                'monday' => true,
                'tuesday' => true,
                'wednesday' => true,
                'thursday' => true,
                'friday' => true,
                'saturday' => false,
                'sunday' => false,
                'start_date' => Carbon::createFromDate(2020, 3, 23),
                'end_date' => Carbon::createFromDate(2020, 5, 29)
            ]
        );
        $serviceIndustriel = StaticCalendar::firstOrCreate(
            ['service_id' => '20M-INDUSTRIEL-00-S'],
            [
                'monday' => true,
                'tuesday' => true,
                'wednesday' => true,
                'thursday' => true,
                'friday' => true,
                'saturday' => false,
                'sunday' => false,
                'start_date' => Carbon::createFromDate(2020, 3, 23),
                'end_date' => Carbon::createFromDate(2020, 5, 29)
            ]
        );

        // Go through each school trip
        foreach (RealtimeTrip::where('route_id', 'LIKE', '%E')->get() as $schoolRealtimeTrip) {
            // Find or create the route
            $staticRoute = StaticRoute::firstOrCreate(
                ['route_id' => $schoolRealtimeTrip->route_id],
                [
                    'gtfs_agency_id' => 1,
                    'route_short_name' => $schoolRealtimeTrip->route_id,
                    'route_long_name' => 'TBD',
                    'route_type' => 3,
                    'route_url' => 'http://www.stm.info/fr/infos/reseaux/bus',
                    'route_color' => '009EE0',
                    'route_text_color' => ''
                ]
            );

            // Update or create the trip
            $staticTrip = StaticTrip::updateOrCreate(
                ['trip_id' => $schoolRealtimeTrip->trip_id],
                [
                    'gtfs_route_id' => $staticRoute->id,
                    'gtfs_service_id' => $serviceEcole->id,
                    'trip_headsign' => $schoolRealtimeTrip->route_id,
                    'shape_id' => '',
                    'weelchair_accessible' => 0,
                    'note_fr' => 'TBD',
                    'note_en' => 'TBD'
                ]
            );

            // Call the function to generate stop time update
            $this->generateStopTimeUpdate($schoolRealtimeTrip, $staticTrip);
        }

        // Go through each industrial trip
        foreach (RealtimeTrip::where('route_id', 'LIKE', '%I')->get() as $industrialRealtimeTrip) {
            // Find or create the route
            $staticRoute = StaticRoute::firstOrCreate(
                ['route_id' => $industrialRealtimeTrip->route_id],
                [
                    'gtfs_agency_id' => 1,
                    'route_short_name' => $industrialRealtimeTrip->route_id,
                    'route_long_name' => 'TBD',
                    'route_type' => 3,
                    'route_url' => 'http://www.stm.info/fr/infos/reseaux/bus',
                    'route_color' => '009EE0',
                    'route_text_color' => ''
                ]
            );

            // Update or create the trip
            $staticTrip = StaticTrip::updateOrCreate(
                ['trip_id' => $industrialRealtimeTrip->trip_id],
                [
                    'gtfs_route_id' => $staticRoute->id,
                    'gtfs_service_id' => $serviceIndustriel->id,
                    'trip_headsign' => $industrialRealtimeTrip->route_id,
                    'shape_id' => '',
                    'weelchair_accessible' => 0,
                    'note_fr' => 'TBD',
                    'note_en' => 'TBD'
                ]
            );

            // Call the function to generate stop time update
            $this->generateStopTimeUpdate($industrialRealtimeTrip, $staticTrip);
        }
    }

    /**
     * Generate stop time update.
     *
     * @param $realtimeTrip
     * @param $staticTrip
     * @return void
     */
    private function generateStopTimeUpdate($realtimeTrip, $staticTrip)
    {
        foreach ($realtimeTrip->stop_time_updates as $stopTimeUpdate) {
            $staticStop = StaticStop::firstOrCreate(
                ['stop_id' => $stopTimeUpdate['stop_id']],
                [
                    'stop_code' => $stopTimeUpdate['stop_id'],
                    'stop_name' => 'TBD',
                    'stop_lat' => 45.446466,
                    'stop_lon' => -73.603118
                ]
            );

            StaticStopTime::updateOrCreate(
                [
                    'gtfs_trip_id' => $staticTrip->id,
                    'gtfs_stop_id' => $staticStop->id
                ],
                [
                    'arrival_time' => $stopTimeUpdate['arrival_time'],
                    'departure_time' => $stopTimeUpdate['departure_time'],
                    'stop_sequence' => $stopTimeUpdate['stop_sequence']
                ]
            );
        }
    }
}
