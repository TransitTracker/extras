<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trip_id', 'start_time', 'route_id', 'stop_time_updates'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'stop_time_updates' => 'array'
    ];

    /**
     * Get the sight that owns this trip.
     */
    public function sight()
    {
        return $this->belongsTo(Sight::class);
    }
}