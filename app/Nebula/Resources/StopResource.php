<?php

namespace App\Nebula\Resources;

use App\Models\Gtfs\Stop;
use Larsklopstra\Nebula\Contracts\NebulaResource;
use Larsklopstra\Nebula\Fields\Boolean;
use Larsklopstra\Nebula\Fields\Input;

class StopResource extends NebulaResource
{
    protected $searchable = [];

    public function fields(): array
    {
        return [
            Input::make('stop_id')->label('ID'),
            Input::make('stop_code')->label('Code'),
            Input::make('stop_name')->label('Name'),
            Input::make('stop_lat')->label('Latitude'),
            Input::make('stop_lon')->label('Longitude'),
            Input::make('stop_url')->label('URL'),
            Input::make('location_type')->label('Type'),
            Input::make('parent_station')->label('Parent station'),
            Input::make('wheelchair_boarding')->label('Wheelchair boarding'),
            Boolean::make('is_fake')->label('Is fake?'),
        ];
    }

    public function model()
    {
        return Stop::class;
    }
}
