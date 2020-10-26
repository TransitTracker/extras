<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixTypoOnGtfsTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gtfs_trips', function (Blueprint $table) {
            $table->renameColumn('weelchair_accessible', 'wheelchair_accessible');
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
            $table->renameColumn('wheelchair_accessible', 'weelchair_accessible');
        });
    }
}
