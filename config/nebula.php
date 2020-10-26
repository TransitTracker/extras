<?php

use App\Nebula\Resources\AgencyResource;
use App\Nebula\Resources\CalendarResource;
use App\Nebula\Resources\FeedInfoResource;
use App\Nebula\Resources\GtfsAgencyResource;
use App\Nebula\Resources\RouteResource;
use App\Nebula\Resources\StopResource;
use App\Nebula\Resources\StopTimeResource;
use App\Nebula\Resources\SuggestionResource;
use App\Nebula\Resources\TripResource;
use App\Nebula\Resources\UserResource;
use Larsklopstra\Nebula\Http\Middleware\NebulaIPAuthStrategy;

return [

    'name' => 'Nebula',

    'prefix' => '/nebula',

    'domain' => null,

    'auth_strategy' => NebulaIPAuthStrategy::class,

    'allowed_ips' => [
        '127.0.0.1',
    ],

    'allowed_emails' => [
        // 'admin@example.com',
    ],

    'resources' => [
        new UserResource,
        new SuggestionResource,
        new AgencyResource,
        new CalendarResource,
        new FeedInfoResource,
        new RouteResource,
        new StopResource,
        new StopTimeResource,
        new TripResource,
    ],

    'dashboards' => [
        // new UserDashboard,
    ],

];
