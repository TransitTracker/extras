<?php

namespace App\Model;

use App\Model\GTFS\Trip as StaticTrip;
use Illuminate\Database\Eloquent\Model;

class Sight extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'trip_id', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'
    ];

    /**
     * Get the trip that owns this sight.
     */
    public function trip()
    {
        return $this->belongsTo(StaticTrip::class);
    }
}
