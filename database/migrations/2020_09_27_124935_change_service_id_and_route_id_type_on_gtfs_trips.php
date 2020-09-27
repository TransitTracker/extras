<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeServiceIdAndRouteIdTypeOnGtfsTrips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gtfs_trips', function (Blueprint $table) {
            $table->string('service_id')->change();
            $table->string('route_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gtfs_trips', function (Blueprint $table) {
            $table->unsignedInteger('service_id')->change();
            $table->unsignedInteger('route_id')->change();
        });
    }
}
