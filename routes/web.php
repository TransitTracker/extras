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

use App\Model\Trip;
use App\Jobs\ProcessTripUpdate;
use FelixINX\TransitRealtime\FeedMessage;

$router->get('/', function () use ($router) {
    $trips = Trip::all();
    return view('index', compact('trips'));
});

$router->get('/dispatch', function () use ($router) {
    if (app()->environment('local')) {
//        dispatch(new ProcessTripUpdate());
    }

    redirect('/');
});
