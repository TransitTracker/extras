<?php

use App\Models\Suggestion;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPolymorphicRelationToSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->unsignedInteger('suggestible_id')->nullable();
            $table->string('suggestible_type')->nullable();
        });

        foreach (Suggestion::all() as $suggestion) {
            if ($stop_id = $suggestion->stop_id) {
                $suggestion->suggestible_id = $stop_id;
                $suggestion->suggestible_type = 'Stop';
            } else if ($trip_id = $suggestion->trip_id) {
                $suggestion->suggestible_id = $trip_id;
                $suggestion->suggestible_type = 'Trip';
            }
            $suggestion->save();
        }

        Schema::table('suggestions', function (Blueprint $table) {
            $table->dropColumn(['stop_id', 'trip_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suggestions', function (Blueprint $table) {
            $table->dropColumn(['suggestible_id', 'suggestible_string']);
            $table->unsignedInteger('stop_id');
            $table->unsignedInteger('trip_id');
        });
    }
}
