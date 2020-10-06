<?php

namespace App\Models\Gtfs;

use App\Models\Suggestion;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{
    protected $table = 'gtfs_stops';
    protected $primaryKey = 'stop_id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stop_id', 'stop_code', 'stop_name', 'stop_lat', 'stop_lon', 'stop_url', 'location_type', 'parent_station',
        'wheelchair_boarding', 'is_fake',
    ];

    /**
     * Get the stop times for the stop.
     */
    public function stop_times()
    {
        return $this->hasMany(StopTime::class, 'stop_id');
    }

    /**
     * Get the suggestions for the stop.
     */
    public function suggestions()
    {
        return $this->morphMany(Suggestion::class, 'suggestible');
    }

    /**
     * Get the suggestions for the stop.
     */
    public function trips()
    {
        $tripIds = StopTime::where('stop_id', $this->stop_id)->select('trip_id')->get();
        return Trip::whereIn('trip_id', $tripIds)->get();
    }
}
