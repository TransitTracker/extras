<?php

namespace App\Model\GTFS;

use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gtfs_stops';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stop_id', 'stop_name', 'stop_lat', 'stop_lon'
    ];

    /**
     * Get the stop times for the stop.
     */
    public function stop_times()
    {
        return $this->hasMany(StopTime::class, 'gtfs_stop_id');
    }
}