<?php

namespace App\Model\Gtfs;

use Illuminate\Database\Eloquent\Model;

class StopTime extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gtfs_stop_times';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gtfs_trip_id', 'arrival_time', 'departure_time', 'gtfs_stop_id', 'stop_sequence'
    ];

    /**
     * Get the trip that owns this stop time.
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class, 'gtfs_trip_id');
    }

    /**
     * Get the stop that owns this stop time.
     */
    public function stop()
    {
        return $this->belongsTo(Stop::class, 'gtfs_stop_id');
    }
}
