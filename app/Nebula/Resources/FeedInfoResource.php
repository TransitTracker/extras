<?php

namespace App\Nebula\Resources;

use App\Models\Gtfs\FeedInfo;
use Larsklopstra\Nebula\Contracts\NebulaResource;
use Larsklopstra\Nebula\Fields\Input;

class FeedInfoResource extends NebulaResource
{
    protected $searchable = [];

    public function columns(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [
            Input::make('Feed Publisher Name'),
        ];
    }

    public function model()
    {
        return FeedInfo::class;
    }
}
