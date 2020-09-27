<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeAgencyIdTypeOnGtfsRoutes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gtfs_routes', function (Blueprint $table) {
            $table->string('agency_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gtfs_routes', function (Blueprint $table) {
            $table->unsignedInteger('agency_id')->change();
        });
    }
}
