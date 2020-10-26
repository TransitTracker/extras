<?php

namespace App\Nebula\Resources;

use App\Models\Gtfs\StopTime;
use Larsklopstra\Nebula\Contracts\NebulaResource;
use Larsklopstra\Nebula\Fields\Input;

class StopTimeResource extends NebulaResource
{
    protected $searchable = [];

    public function columns(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [
            Input::make('Trip ID'),
            Input::make('Arrival time'),
            Input::make('Departure time'),
            Input::make('Stop ID'),
            Input::make('Stop sequence'),
            Input::make('Schedule relationship'),
        ];
    }

    public function model()
    {
        return StopTime::class;
    }
}
