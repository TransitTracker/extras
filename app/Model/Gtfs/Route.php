<?php

namespace App\Model\Gtfs;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gtfs_routes';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'route_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'route_id', 'gtfs_agency_id', 'route_short_name', 'route_long_name', 'route_type', 'route_url', 'route_color',
        'route_text_color'
    ];

    /**
     * Get the agency that owns this route.
     */
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'gtfs_agency_id');
    }

    /**
     * Get the trips for the route.
     */
    public function trips()
    {
        return $this->hasMany(Trip::class, 'gtfs_route_id');
    }
}
