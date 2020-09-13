<?php

namespace App\Model\Gtfs;

use App\Model\Suggestion;
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
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'stop_id';

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
        return $this->hasMany(StopTime::class, 'gtfs_stop_id');
    }

    /**
     * Get the suggestions for the stop.
     */
    public function suggestions()
    {
        return $this->hasMany(Suggestion::class, 'stop_id');
    }
}
