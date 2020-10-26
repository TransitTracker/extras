<?php

namespace App\Nebula\Resources;

use Larsklopstra\Nebula\Contracts\NebulaResource;

class UserResource extends NebulaResource
{
    protected $searchable = [];

    public function columns(): array
    {
        return [];
    }

    public function fields(): array
    {
        return [];
    }
}
