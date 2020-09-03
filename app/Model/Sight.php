<?php

namespace App\Model;

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
        return $this->belongsTo(Trip::class);
    }
}
