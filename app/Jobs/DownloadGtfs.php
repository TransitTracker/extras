<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DownloadGtfs implements ShouldQueue
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
        $response = Http::get('http://www.stm.info/sites/default/files/gtfs/gtfs_stm.zip');

        Storage::put('original/download.zip', $response->body());

        $zip = new \ZipArchive();
        $zip->open('./storage/app/original/download.zip');
        $zip->extractTo('./storage/app/original');
        $zip->close();

        ProcessStopFile::dispatch('original/stops.txt');
    }
}
