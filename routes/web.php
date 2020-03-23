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

use App\Jobs\ProcessTripUpdate;
use App\Trip;
use FelixINX\TransitRealtime\FeedMessage;

$router->get('/', function () use ($router) {
    $trips = Trip::all();
    return view('index', compact('trips'));
});

$router->get('/dispatch', function () use ($router) {
    dispatch(new ProcessTripUpdate());
});
