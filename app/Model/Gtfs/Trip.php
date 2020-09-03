<?php

namespace App\Model\Gtfs;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gtfs_trips';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gtfs_route_id', 'gtfs_service_id', 'trip_id', 'trip_headsign', 'direction_id', 'shape_id',
        'weelchair_accessible', 'note_fr', 'note_en'
    ];

    /**
     * Get the route that owns this trip.
     */
    public function route()
    {
        return $this->belongsTo(Route::class, 'gtfs_route_id');
    }

    /**
     * Get the service that owns this trip.
     */
    public function service()
    {
        return $this->belongsTo(Calendar::class, 'gtfs_service_id');
    }

    /**
     * Get the stop times for the trip.
     */
    public function stop_times()
    {
        return $this->hasMany(StopTime::class, 'gtfs_trip_id');
    }
}
