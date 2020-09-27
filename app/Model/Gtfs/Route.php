<?php

namespace App\Model\Gtfs;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'gtfs_routes';
    protected $primaryKey = 'route_id';
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_id', 'agency_id', 'route_short_name', 'route_long_name', 'route_type', 'route_url', 'route_color',
        'route_text_color'
    ];

    /**
     * Get the agency that owns this route.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'agency_id');
    }

    /**
     * Get the trips for the route.
     */
    public function trips()
    {
        return $this->hasMany(Trip::class, 'route_id');
    }
}
