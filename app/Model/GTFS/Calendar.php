<?php

namespace App\Model\GTFS;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gtfs_calendar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service_id', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'start_date',
        'end_date'
    ];

    /**
     * Get the trips for the route.
     */
    public function trips()
    {
        return $this->hasMany(Trip::class, 'gtfs_service_id');
    }

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Ymd');
    }
}