<?php

namespace App\Nebula\Resources;

use App\Models\Gtfs\Calendar;
use Larsklopstra\Nebula\Contracts\NebulaResource;
use Larsklopstra\Nebula\Fields\Boolean;
use Larsklopstra\Nebula\Fields\Date;
use Larsklopstra\Nebula\Fields\Input;

class CalendarResource extends NebulaResource
{
    protected $searchable = [];

    public function columns(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [
            Input::make('service_id')->label('ID'),
            Boolean::make('Monday'),
            Boolean::make('Tuesday'),
            Boolean::make('Wednesday'),
            Boolean::make('Thursday'),
            Boolean::make('Friday'),
            Boolean::make('Saturday'),
            Boolean::make('Sunday'),
            Date::make('Start Date')->format('Ymd'),
            Date::make('End Date')->format('Ymd'),
        ];
    }

    public function model()
    {
        return Calendar::class;
    }
}
