<?php

namespace App\Models;

use App\Models\Gtfs\Stop as StaticStop;
use App\Models\Gtfs\Trip as StaticTrip;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'suggestible_id', 'suggestible_type', 'payload',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'payload' => 'array'
    ];

    /**
     * Get the stop or trip that belong to this suggestion.
     */
    public function suggestible()
    {
        return $this->morphTo();
    }
}
