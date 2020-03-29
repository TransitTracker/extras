<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gtfs_agency', function (Blueprint $table) {
            $table->index('agency_id');
        });

        Schema::table('gtfs_stops', function (Blueprint $table) {
            $table->index('stop_id');
        });

        Schema::table('gtfs_stop_times', function (Blueprint $table) {
            $table->index(['gtfs_trip_id', 'gtfs_stop_id']);
        });

        Schema::table('gtfs_calendar', function (Blueprint $table) {
            $table->index('service_id');
        });

        Schema::table('sights', function (Blueprint $table) {
            $table->index('trip_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gtfs_agency', function (Blueprint $table) {
            $table->dropIndex('agency_id');
        });

        Schema::table('gtfs_stops', function (Blueprint $table) {
            $table->dropIndex('stop_id');
        });

        Schema::table('gtfs_stop_times', function (Blueprint $table) {
            $table->dropIndex(['gtfs_trip_id', 'gtfs_stop_id']);
        });

        Schema::table('gtfs_calendar', function (Blueprint $table) {
            $table->dropIndex('service_id');
        });

        Schema::table('sights', function (Blueprint $table) {
            $table->dropIndex('trip_id');
        });
    }
}
