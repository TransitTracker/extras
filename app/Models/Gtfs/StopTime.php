<?php

namespace App\Models\Gtfs;

use Illuminate\Database\Eloquent\Model;

class StopTime extends Model
{
    protected $table = 'gtfs_stop_times';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trip_id', 'arrival_time', 'departure_time', 'stop_id', 'stop_sequence', 'schedule_relationship'
    ];

    /**
     * Get the trip that owns this stop time.
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id');
    }

    /**
     * Get the stop that owns this stop time.
     */
    public function stop()
    {
        return $this->belongsTo(Stop::class, 'stop_id');
    }
}
