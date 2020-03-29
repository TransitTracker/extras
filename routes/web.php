<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Jobs\GenerateCsvFiles;
use App\Jobs\GenerateStaticGtfs;
use App\Jobs\ProcessStopFile;
use App\Model\Trip;
use App\Jobs\ProcessTripUpdate;
use Illuminate\Support\Facades\Storage;

$router->get('/', function () use ($router) {
    $trips = Trip::all();
    return view('index', compact('trips'));
});

$router->get('/dispatch', function () use ($router) {
    if (app()->environment('local')) {
        dispatch(new ProcessTripUpdate());
    }

    return redirect('/');
});

$router->get('/generate', function () use ($router) {
    if (app()->environment('local')) {
//        dispatch(new GenerateStaticGtfs());
//        dispatch(new ProcessStopFile(env('STOP_FILE_URL')));
        dispatch(new GenerateCsvFiles());
    }

    return redirect('/');
});

$router->get('/import', function () use ($router) {
    if (app()->environment('local')) {
    }

    return redirect('/');
});

$router->get('/download', function () use ($router) {
    $directories = Storage::directories('public');
    return view ('download', compact('directories'));
});
