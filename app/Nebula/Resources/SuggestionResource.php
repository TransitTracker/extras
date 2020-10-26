<?php

namespace App\Nebula\Resources;

use Larsklopstra\Nebula\Contracts\NebulaResource;
use Larsklopstra\Nebula\Fields\Input;

class SuggestionResource extends NebulaResource
{
    protected $searchable = [];

    public function fields(): array
    {
        return [
            Input::make('suggestible_id')->label('ID'),
            Input::make('suggestible_type')->label('Type'),
            Input::make('payload.username')->label('Username'),
            Input::make('payload.real_stop')->label('Real stop ID'),
            Input::make('payload.stop_name')->label('Stop name'),
            Input::make('payload.stop_location')->label('Stop location'),
            Input::make('payload.trip_notes')->label('Trip notes'),
            Input::make('payload.trip_headsign')->label('Trip headsign'),
        ];
    }
}
