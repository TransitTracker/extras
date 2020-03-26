<?php

namespace App\Model\GTFS;

use Sushi\Sushi;
use Illuminate\Database\Eloquent\Model;

class FeedInfo extends Model
{
    use Sushi;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'gtfs_feed_info';

    /**
     * Define the static rows
     */
    protected $rows = [
        [
            'feed_publisher_name' => '@austinhuang0131 and @felixinx',
            'feed_publisher_url' => 'https://stm.austinhuang.me/',
            'feed_lang' => 'fr',
            'feed_start_date' => '20200323',
            'feed_end_date' => '20200531'
        ]
    ];
}