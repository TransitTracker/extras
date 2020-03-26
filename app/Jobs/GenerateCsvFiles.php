<?php

namespace App\Jobs;

use App\Model\GTFS\Stop;
use App\Model\GTFS\Trip;
use League\Csv\Writer;
use App\Model\GTFS\Route;
use App\Model\GTFS\Agency;
use App\Model\GTFS\Calendar;
use App\Model\GTFS\FeedInfo;
use App\Model\GTFS\StopTime;

class GenerateCsvFiles extends Job
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
        // Global variables
        $date = date('Ymd');

        // agency.txt
        $agencyColumns = [
            'agency_id', 'agency_name', 'agency_url', 'agency_timezone', 'agency_lang', 'agency_phone',
            'agency_fare_url'
        ];
        $agency = Agency::select($agencyColumns)->get();
        $agencyWriter = Writer::createFromPath(storage_path('app/public/') . $date . '/agency.txt', 'w+');
        $agencyWriter->insertOne($agencyColumns);
        foreach ($agency as $agency) {
            $agencyWriter->insertOne($agency->toArray());
        }

        // calendar.txt
        $calendarColumns = [
            'service_id', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'start_date',
            'end_date'
        ];
        $calendar = Calendar::select($calendarColumns)->get();
        $calendarWriter = Writer::createFromPath(storage_path('app/public/') . $date . '/calendar.txt', 'w+');
        $calendarWriter->insertOne($calendarColumns);
        foreach ($calendar as $calendar) {
            $calendarWriter->insertOne($calendar->toArray());
        }

        // feed_info.txt
        $feedInfoColumns = [
            'feed_publisher_name', 'feed_publisher_url', 'feed_publisher_url', 'feed_start_date', 'feed_end_date'
        ];
        $feedInfo = FeedInfo::select($feedInfoColumns)->get();
        $feedInfoWriter = Writer::createFromPath(storage_path('app/public/') . $date . '/feed_info.txt', 'w+');
        $feedInfoWriter->insertOne($feedInfoColumns);
        foreach ($feedInfo as $feedInfo) {
            $feedInfoWriter->insertOne($feedInfo->toArray());
        }

        // routes.txt
        $routes = collect(Route::all());
        $routesCollection = $routes->map(function ($item, $key) {
            return [
                'route_id' => $item->route_id,
                'agency_id' => $item->agency->agency_id,
                'route_short_name' => $item->route_short_name,
                'route_long_name' => $item->route_long_name,
                'route_type' => $item->route_type,
                'route_url' => $item->route_url,
                'route_color' => $item->route_color,
                'route_text_color' => $item->route_text_color
            ];
        });
        $routesWriter = Writer::createFromPath(storage_path('app/public/') . $date . '/routes.txt', 'w+');
        $routesWriter->insertOne([
            'route_id', 'agency_id', 'route_short_name', 'route_long_name', 'route_type', 'route_url', 'route_color',
            'route_text_color'
        ]);
        $routesWriter->insertAll($routesCollection);


        // stops.txt
        $stopsColumns = [
            'stop_id', 'stop_code', 'stop_name', 'stop_lat', 'stop_lon', 'stop_url', 'location_type', 'parent_station',
            'wheelchair_boarding'
        ];
        $stops = Stop::select($stopsColumns)->get();
        $stopsWriter = Writer::createFromPath(storage_path('app/public/') . $date . '/stops.txt', 'w+');
        $stopsWriter->insertOne($stopsColumns);
        foreach ($stops as $stop) {
            $stopsWriter->insertOne($stop->toArray());
        }

        // stop_times.txt
        $stopTimes = collect(StopTime::all());
        $stopTimesCollection = $stopTimes->map(function ($item, $key) {
            return [
                'trip_id' => $item->trip->trip_id,
                'arrival_time' => $item->arrival_time,
                'departure_time' => $item->departure_time,
                'stop_id' => $item->stop->stop_id,
                'stop_sequence' => $item->stop_sequence
            ];
        });
        $stopTimesWriter = Writer::createFromPath(storage_path('app/public/') . $date . '/stop_times.txt', 'w+');
        $stopTimesWriter->insertOne([
            'trip_id', 'arrival_time', 'departure_time', 'stop_id', 'stop_sequence'
        ]);
        $stopTimesWriter->insertAll($stopTimesCollection);

        // trips.txt
        $trips = collect(Trip::all());
        $tripsCollection = $trips->map(function ($item, $key) {
            return [
                'route_id' => $item->route->route_id,
                'service_id' => $item->service->service_id,
                'trip_id' => $item->trip_id,
                'trip_headsign' => $item->trip_headsign,
                'direction_id' => $item->direction_id,
                'shape_id' => $item->shape_id,
                'wheelchair_accessible' => $item->wheelchair_accessible,
                'note_fr' => $item->note_fr,
                'note_en' => $item->note_en
            ];
        });
        $tripsWriter = Writer::createFromPath(storage_path('app/public/') . $date . '/trips.txt', 'w+');
        $tripsWriter->insertOne([
            'route_id', 'service_id', 'trip_id', 'trip_headsign', 'direction_id', 'shape_id', 'wheelchair_accessible',
            'note_fr', 'note_en'
        ]);
        $tripsWriter->insertAll($tripsCollection);

        // Clean all writers
        $agencyWriter = null;
        $calendarWriter = null;
        $feedInfoWriter = null;
        $routesWriter = null;
        $stopsWriter = null;
        $stopTimesWriter = null;
        $tripsWriter = null;
    }
}
