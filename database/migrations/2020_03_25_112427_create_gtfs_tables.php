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
            $table->string('agency_lang');
            $table->string('agency_phone')->nullable();
            $table->string('agency_fare_url');
            $table->timestamps();
        });

        Schema::create('gtfs_stops', function (Blueprint $table) {
            $table->id();
            $table->string('stop_id');
            $table->string('stop_code');
            $table->string('stop_name');
            $table->float('stop_lat', 7, 5);
            $table->float('stop_lon', 7, 5);
            $table->string('stop_url')->nullable();
            $table->string('location_type')->default(0);
            $table->string('parent_station')->nullable();
            $table->string('wheelchair_boarding')->default(0);
            $table->timestamps();

        });

        Schema::create('gtfs_routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_id')->unique();
            $table->unsignedInteger('gtfs_agency_id');
            $table->string('route_short_name');
            $table->string('route_long_name');
            $table->string('route_type')->default(3);
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
            $table->boolean('direction_id')->nullable();
            $table->string('shape_id')->nullable();
            $table->string('weelchair_accessible')->nullable();
            $table->string('note_fr')->nullable();
            $table->string('note_en')->nullable();
            $table->timestamps();
        });

        Schema::create('gtfs_stop_times', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('gtfs_trip_id');
            $table->time('arrival_time');
            $table->time('departure_time');
            $table->unsignedInteger('gtfs_stop_id');
            $table->integer('stop_sequence');
            $table->timestamps();
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
            $table->timestamps();
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gtfs_agency');
        Schema::dropIfExists('gtfs_stops');
        Schema::dropIfExists('gtfs_routes');
        Schema::dropIfExists('gtfs_trips');
        Schema::dropIfExists('gtfs_stop_times');
        Schema::dropIfExists('gtfs_calendar');
        Schema::dropIfExists('gtfs_feed_info');
    }
}
