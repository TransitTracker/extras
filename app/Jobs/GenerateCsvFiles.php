<?php

namespace App\Jobs;

use App\Models\Gtfs\Agency;
use App\Models\Gtfs\Calendar;
use App\Models\Gtfs\FeedInfo;
use App\Models\Gtfs\Route;
use App\Models\Gtfs\Stop;
use App\Models\Gtfs\StopTime;
use App\Models\Gtfs\Trip;
use App\Models\Period;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Writer;
use ZipArchive;

class GenerateCsvFiles implements ShouldQueue
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
        // Global variables
        $folder = 'public/archive/' . date('Ymd');

        // Create directory structure
        Storage::makeDirectory($folder);

        Storage::put($folder . '/extras_calendar.txt', '');
        Storage::put($folder . '/extras_routes.txt', '');
        Storage::put($folder . '/extras_stop_times.txt', '');
        Storage::put($folder . '/extras_trips.txt', '');

        Storage::put($folder . '/agency.txt', '');
        Storage::copy('original/calendar.txt', $folder . '/calendar.txt');
        Storage::copy('original/calendar_dates.txt', $folder . '/calendar_dates.txt');
        Storage::copy('original/fare_attributes.txt', $folder . '/fare_attributes.txt');
        Storage::copy('original/fare_rules.txt', $folder . '/fare_rules.txt');
        Storage::put($folder . '/feed_info.txt', '');
        Storage::copy('original/frequencies.txt', $folder . '/frequencies.txt');
        Storage::copy('original/routes.txt', $folder . '/routes.txt');
        Storage::copy('original/shapes.txt', $folder . '/shapes.txt');
        Storage::copy('original/stop_times.txt', $folder . '/stop_times.txt');
        Storage::put($folder . '/stops.txt', '');
        Storage::copy('original/trips.txt', $folder . '/trips.txt');

        // agency.txt
        $agencyColumns = [
            'agency_id', 'agency_name', 'agency_url', 'agency_timezone', 'agency_lang', 'agency_phone',
            'agency_fare_url'
        ];
        $agency = Agency::select($agencyColumns)->get();
        $agencyWriter = Writer::createFromPath(storage_path('app/') . $folder . '/agency.txt', 'w+');
        $agencyWriter->insertOne($agencyColumns);
        foreach ($agency as $agency) {
            $agencyWriter->insertOne($agency->toArray());
        }

        // calendar.txt
        $services = collect(Route::all());
        $servicesCollection = $services->map(function ($item) {
            return [
                'service_id' => $item->service_id,
                'monday' => $item->monday,
                'tuesday' => $item->tuesday,
                'wednesday' => $item->wednesday,
                'thursday' => $item->thursday,
                'friday' => $item->friday,
                'saturday' => $item->saturday,
                'sunday' => $item->sunday,
                'start_date' => $item->start_date,
                'end_date' => $item->end_date,
            ];
        });
        $calendarWriter = Writer::createFromPath(storage_path('app/') . $folder . '/extras_calendar.txt', 'w+');
        $calendarWriter->insertOne([
            'service_id', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'start_date',
            'end_date'
        ]);
        $calendarWriter->insertAll($servicesCollection);
        $completeCalendarWriter = Writer::createFromPath(storage_path("app/{$folder}/calendar.txt"), 'a+');
        $completeCalendarWriter->insertAll($servicesCollection);

        // feed_info.txt
        $feedInfoColumns = [
            'feed_publisher_name', 'feed_publisher_url', 'feed_lang', 'feed_start_date', 'feed_end_date'
        ];
        $feedInfo = FeedInfo::select($feedInfoColumns)->get();
        $feedInfoWriter = Writer::createFromPath(storage_path('app/') . $folder . '/feed_info.txt', 'w+');
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
        $routesWriter = Writer::createFromPath(storage_path('app/') . $folder . '/extras_routes.txt', 'w+');
        $routesWriter->insertOne([
            'route_id', 'agency_id', 'route_short_name', 'route_long_name', 'route_type', 'route_url', 'route_color',
            'route_text_color'
        ]);
        $routesWriter->insertAll($routesCollection);
        $completeRoutesWriter = Writer::createFromPath(storage_path("app/{$folder}/routes.txt"), 'a+');
        $completeRoutesWriter->insertAll($routesCollection);


        // stops.txt
        $stopsColumns = [
            'stop_id', 'stop_code', 'stop_name', 'stop_lat', 'stop_lon', 'stop_url', 'location_type', 'parent_station',
            'wheelchair_boarding'
        ];
        $stops = Stop::select($stopsColumns)->get();
        $stopsWriter = Writer::createFromPath(storage_path('app/') . $folder . '/stops.txt', 'w+');
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
        $stopTimesWriter = Writer::createFromPath(storage_path('app/') . $folder . '/extras_stop_times.txt', 'w+');
        $stopTimesWriter->insertOne([
            'trip_id', 'arrival_time', 'departure_time', 'stop_id', 'stop_sequence'
        ]);
        $stopTimesWriter->insertAll($stopTimesCollection);
        $completeStopTimesWriter = Writer::createFromPath(storage_path("app/{$folder}/stop_times.txt"), 'a+');
        $completeStopTimesWriter->insertAll($stopTimesCollection);

        // trips.txt
        $trips = collect(Trip::all());
//        $trips = collect(Trip::where('service_id', 'LIKE', "{$this->getPeriod()->period}-%")->get());
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
        $tripsWriter = Writer::createFromPath(storage_path('app/') . $folder . '/extras_trips.txt', 'w+');
        $tripsWriter->insertOne([
            'route_id', 'service_id', 'trip_id', 'trip_headsign', 'direction_id', 'shape_id', 'wheelchair_accessible',
            'note_fr', 'note_en'
        ]);
        $tripsWriter->insertAll($tripsCollection);
        $completeTripsWriter = Writer::createFromPath(storage_path("app/{$folder}/trips.txt"), 'a+');
        $completeTripsWriter->insertAll($tripsCollection);

        // Create a ZIP file
        $zip = new ZipArchive();
        $files = [
            'agency.txt',
            'calendar.txt',
            'calendar_dates.txt',
            'fare_attributes.txt',
            'fare_rules.txt',
            'feed_info.txt',
            'frequencies.txt',
            'routes.txt',
            'shapes.txt',
            'stop_times.txt',
            'stops.txt',
            'trips.txt',
        ];

        if ($zip->open(storage_path("app/{$folder}/gtfs_stm_extended.zip"), ZipArchive::CREATE) === true) {
            foreach ($files as $file) {
                $zip->addFile(storage_path("app/{$folder}/{$file}"), basename($file));
            }

            $zip->close();
        }
        
        // Create symlink to latest folder
        Storage::copy("$folder/gtfs_stm_extended.zip", 'public/latest/gtfs_stm_extended.zip');

        // Clean all writers
        $agencyWriter = null;
        $calendarWriter = null;
        $completeCalendarWriter = null;
        $feedInfoWriter = null;
        $routesWriter = null;
        $completeRoutesWriter = null;
        $stopsWriter = null;
        $stopTimesWriter = null;
        $completeStopTimesWriter = null;
        $tripsWriter = null;
        $completeTripsWriter = null;
        $zip = null;
    }

    private function getPeriod (): Period
    {
        return Period::whereDate('start_date', '<=', today())->whereDate('end_date', '>=', today())->first();
    }
}
