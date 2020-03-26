<?php

namespace App\Console\Commands;

use League\Csv\Reader;
use App\Model\GTFS\Stop;
use Illuminate\Console\Command;

class ProcessStopFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gtfs:addstops {file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add GTFS stops to the database from CSV file';

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
     * @return mixed
     */
    public function handle()
    {
        $csv = Reader::createFromPath(getcwd() . '/' . $this->argument('file'), 'r')->setHeaderOffset(0);
        $csvStops = $csv->getRecords();

        $bar = $this->output->createProgressBar(count($csv));
        $bar->start();

        foreach ($csvStops as $csvStop) {
            Stop::updateOrCreate(
                ['stop_id' => $csvStop['stop_id']],
                [
                    'stop_code' => $csvStop['stop_code'],
                    'stop_name' => $csvStop['stop_name'],
                    'stop_lat' => $csvStop['stop_lat'],
                    'stop_lon' => $csvStop['stop_lon'],
                    'stop_url' => $csvStop['stop_url'],
                    'location_type' => $csvStop['location_type'],
                    'parent_station' => $csvStop['parent_station'],
                    'wheelchair_boarding' => $csvStop['wheelchair_boarding'],
                ]
            );

            $bar->advance();
        }
        $bar->finish();
        $this->line();

        $this->info('Successful! ' . count($csv) . ' stops added to the database.');
    }
}