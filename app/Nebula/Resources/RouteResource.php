<?php

namespace App\Nebula\Resources;

use App\Models\Gtfs\Route;
use Larsklopstra\Nebula\Contracts\NebulaResource;
use Larsklopstra\Nebula\Fields\Color;
use Larsklopstra\Nebula\Fields\Input;

class RouteResource extends NebulaResource
{
    protected $searchable = [];

    public function columns(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [
            Input::make('route_id')->label('ID'),
            Input::make('route_short_name')->label('Short name'),
            Input::make('route_long_name')->label('Long name'),
            Input::make('route_type')->label('Type'),
            Input::make('route_url')->label('URL'),
            Color::make('route_color')->label('Color')
                ->colors([
                    '#3b9b74',
                    '#f7e200',
                ]),
            Color::make('route_text_color')->label('Text color')->colors([
                '#ffffff',
                '#000000'
            ]),
        ];
    }

    public function model()
    {
        return Route::class;
    }
}
