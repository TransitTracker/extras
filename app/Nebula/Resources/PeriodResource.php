<?php

namespace App\Nebula\Resources;

use App\Models\Gtfs\Calendar;
use Larsklopstra\Nebula\Contracts\NebulaResource;
use Larsklopstra\Nebula\Fields\Boolean;
use Larsklopstra\Nebula\Fields\Date;
use Larsklopstra\Nebula\Fields\Input;

class PeriodResource extends NebulaResource
{
    protected $searchable = [];

    public function columns(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [
            Input::make('Period'),
            Date::make('Start Date')->format('Ymd'),
            Date::make('End Date')->format('Ymd'),
        ];
    }
}
