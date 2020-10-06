<?php

namespace App\Models\Gtfs;

use App\Models\Sight;
use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $table = 'gtfs_trips';
    protected $primaryKey = 'trip_id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_id', 'service_id', 'trip_id', 'trip_headsign', 'direction_id', 'shape_id',
        'weelchair_accessible', 'note_fr', 'note_en'
    ];

    /**
     * Get the route that owns this trip.
     */
    public function route()
    {
        return $this->belongsTo(Route::class, 'route_id');
    }

    /**
     * Get the service that owns this trip.
     */
    public function service()
    {
        return $this->belongsTo(Calendar::class, 'service_id');
    }

    /**
     * Get the sight that owns this trip.
     */
    public function sight()
    {
        return $this->belongsTo(Sight::class, 'trip_id')->withDefault();
    }

    /**
     * Get the stop times for the trip.
     */
    public function stop_times()
    {
        return $this->hasMany(StopTime::class, 'trip_id');
    }

    /**
     * Get the suggestions for the stop.
     */
    public function suggestions()
    {
        return $this->morphMany(Suggestion::class, 'suggestible');
    }
}
