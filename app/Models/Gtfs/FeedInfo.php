<?php

namespace App\Models\Gtfs;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class FeedInfo extends Model
{
    use Sushi;

    protected $table = 'gtfs_feed_info';

    /**
     * Define the static rows
     */
    protected $rows = [
        [
            'feed_publisher_name' => 'Contributors from Extras Catcher',
            'feed_publisher_url' => 'https://extras.transittracker.ca/',
            'feed_lang' => 'fr',
            'feed_start_date' => '2020-03-23',
            'feed_end_date' => '2020-05-31'
        ]
    ];

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
