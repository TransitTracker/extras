<?php

namespace App\Model\Gtfs;

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
        'stop_id', 'stop_code', 'stop_name', 'stop_lat', 'stop_lon', 'stop_url', 'location_type', 'parent_station',
        'wheelchair_boarding'
    ];

    /**
     * Get the stop times for the stop.
     */
    public function stop_times()
    {
        return $this->hasMany(StopTime::class, 'gtfs_stop_id');
    }
}
