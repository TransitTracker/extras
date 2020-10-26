<?php

namespace App\Nebula\Resources;

use App\Models\Gtfs\Agency;
use Larsklopstra\Nebula\Contracts\NebulaResource;
use Larsklopstra\Nebula\Fields\Input;

class AgencyResource extends NebulaResource
{
    protected $searchable = [];

    public function fields(): array
    {
        return [
            Input::make('agency_id')->label('ID'),
            Input::make('agency_name')->label('Name'),
            Input::make('agency_url')->label('URL'),
            Input::make('agency_timezone')->label('Timezone'),
            Input::make('agency_lang')->label('Lang'),
            Input::make('agency_phone')->label('Phone'),
            Input::make('agency_fare_url')->label('Fare URL'),
        ];
    }

    public function model()
    {
        return Agency::class;
    }
}
