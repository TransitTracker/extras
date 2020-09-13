<?php

namespace App\Model;

use App\Model\Gtfs\Stop as StaticStop;
use App\Model\Gtfs\Trip as StaticTrip;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stop_id', 'trip_id', 'payload',
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
     * Get the stop that owns this suggestion.
     */
    public function stop()
    {
        return $this->belongsTo(StaticStop::class);
    }

    /**
     * Get the trip that owns this sight.
     */
    public function trip()
    {
        return $this->belongsTo(StaticTrip::class);
    }
}
