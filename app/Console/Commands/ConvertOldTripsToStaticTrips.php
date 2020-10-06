<?php

namespace App\Console\Commands;

use App\Models\Gtfs\Calendar;
use App\Models\Gtfs\Route;
use App\Models\Gtfs\StopTime;
use App\Models\Gtfs\Trip as StaticTrip;
use App\Models\Sight;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ConvertOldTripsToStaticTrips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trips:convert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Old trips to new static trips converter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Create new service
        $serviceEcole = Calendar::firstOrcreate(
            ['service_id' => '20S-EXTRASE-1111100'],
            [
                'monday' => true,
                'tuesday' => true,
                'wednesday' => true,
                'thursday' => true,
                'friday' => true,
                'saturday' => false,
                'sunday' => false,
                'start_date' => '20200824',
                'end_date' => '20201023',
            ],
        );
        $serviceIndustriel = Calendar::firstOrCreate(
            ['service_id' => '20S-EXTRASI-1111100'],
            [
                'monday' => true,
                'tuesday' => true,
                'wednesday' => true,
                'thursday' => true,
                'friday' => true,
                'saturday' => false,
                'sunday' => false,
                'start_date' => '20200824',
                'end_date' => '20201023',
            ]
        );

        // Get all old trips
        $oldTrips = Trip::all();

        // Start the bar (aesthetic)
        $bar = $this->output->createProgressBar(count($oldTrips));
        $bar->start();

        foreach ($oldTrips as $oldTrip) {
            $isSchool = (bool) strpos($oldTrip->route_id, 'E');
            // Find or create the static route
            $route = Route::firstOrCreate(
                ['route_id' => $oldTrip->route_id],
                [
                    'agency_id' => 'STM',
                    'route_short_name' => $oldTrip->route_id,
                    'route_long_name' => '' . $isSchool ? 'Ecole' : 'Industriel',
                    'route_type' => 3,
                    'route_url' => null,
                    'route_color' => $isSchool ? '#3b9b74' : '#f7e200',
                    'route_text_color' => $isSchool ? '#ffffff' : '#000000',
                ],
            );

            // Update or create the new static trip
            StaticTrip::updateOrCreate(
                ['trip_id' => $oldTrip->trip_id],
                [
                    'route_id' => $route->route_id,
                    'service_id' => $isSchool ? $serviceEcole->service_id : $serviceIndustriel->service_id,
                    'trip_headsign' => 'TBD',
                    'direction_id' => 0,
                    'shape_id' => null,
                    'weelchair_accessible' => 0,
                    'note_fr' => null,
                    'note_en' => $oldTrip->start_time
                ]
            );



            // Change trip_id attribute on Sight table
            Sight::where('trip_id', $oldTrip->id)
                ->update(['trip_id' => $oldTrip->trip_id]);

            // Update or create each stop time update to static stop time
            foreach ($oldTrip->stop_time_updates as $stopTimeUpdate) {
                StopTime::updateOrCreate(
                    [
                        'trip_id' => $oldTrip->trip_id,
                        'stop_id' => $stopTimeUpdate['stop_id'],
                    ],
                    [
                        'arrival_time' => $stopTimeUpdate['arrival_time'],
                        'departure_time' => $stopTimeUpdate['departure_time'],
                        'stop_sequence' => $stopTimeUpdate['stop_sequence'],
                        'schedule_relationship' => $stopTimeUpdate['schedule_relationship'],
                    ]
                );
            }

            $bar->advance();
        }
        $bar->finish();
    }
}
