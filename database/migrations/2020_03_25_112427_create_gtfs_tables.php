<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGtfsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gtfs_agency', function (Blueprint $table) {
            $table->id();
            $table->string('agency_id');
            $table->string('agency_name');
            $table->string('agency_url');
            $table->string('agency_timezone');
            $table->timestamps();
        });

        Schema::create('gtfs_stops', function (Blueprint $table) {
            $table->id();
            $table->string('stop_id');
            $table->string('stop_name');
            $table->float('stop_lat', 7, 5);
            $table->float('stop_lon', 7, 5);
            $table->timestamps();

        });

        Schema::create('gtfs_routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_id')->unique();
            $table->unsignedInteger('gtfs_agency_id');
            $table->string('route_short_name');
            $table->string('route_long_name');
            $table->string('route_type');
            $table->string('route_url')->nullable();
            $table->string('route_color');
            $table->string('route_text_color')->nullable();
            $table->timestamps();
        });

        Schema::create('gtfs_trips', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('gtfs_route_id');
            $table->unsignedInteger('gtfs_service_id');
            $table->string('trip_id')->unique();
            $table->string('trip_headsign')->nullable();
            $table->string('trip_short_name')->nullable();
            $table->string('shape_id')->nullable();
            $table->timestamps();
        });

        Schema::create('gtfs_stop_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('gtfs_trip_id');
            $table->time('arrival_time');
            $table->time('departure_time');
            $table->unsignedInteger('gtfs_stop_id');
            $table->integer('stop_sequence');
        });

        Schema::create('gtfs_calendar', function (Blueprint $table) {
            $table->id();
            $table->string('service_id');
            $table->boolean('monday');
            $table->boolean('tuesday');
            $table->boolean('wednesday');
            $table->boolean('thursday');
            $table->boolean('friday');
            $table->boolean('saturday');
            $table->boolean('sunday');
            $table->date('start_date');
            $table->date('end_date');
        });

        Schema::create('gtfs_feed_info', function (Blueprint $table) {
            $table->id();
            $table->string('feed_publisher_name');
            $table->string('feed_publisher_url');
            $table->string('feed_lang');
            $table->date('feed_start_date');
            $table->date('feed_end_date');
            $table->string('feed_version');
            $table->string('feed_contact_email')->nullable();
            $table->string('feed_contact_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists([
            'gtfs_agency', 'gtfs_stops', 'gtfs_routes', 'gtfs_trips', 'gtfs_stop_times', 'gtfs_calendar',
            'gtfs_feed_info'
        ]);
    }
}
