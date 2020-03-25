<?php

namespace App\Model\GTFS;

use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gtfs_agency';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'agency_id', 'agency_name', 'agency_url'
    ];

    /**
     * Get the routes for the agency.
     */
    public function routes()
    {
        return $this->hasMany(Route::class, 'gtfs_agency_id');
    }
}