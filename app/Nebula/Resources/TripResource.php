<?php

namespace App\Nebula\Resources;

use App\Models\Gtfs\Trip;
use Larsklopstra\Nebula\Contracts\NebulaResource;
use Larsklopstra\Nebula\Fields\Boolean;
use Larsklopstra\Nebula\Fields\Input;

class TripResource extends NebulaResource
{
    protected $searchable = [];

    public function columns(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [
            Input::make('Route ID'),
            Input::make('Service ID'),
            Input::make('Trip ID'),
            Input::make('trip_headsign')->label('Headsign'),
            Input::make('direction_id')->label('Direction ID'),
            Input::make('Shape ID'),
            Input::make('Wheelchair Accessible'),
            Input::make('Note FR'),
            Input::make('Note EN'),
        ];
    }

    public function model()
    {
        return Trip::class;
    }
}
