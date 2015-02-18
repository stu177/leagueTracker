<?php namespace Stu177\LeagueTracker\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSummonerTable extends Migration
{

	public function up()
	{
        Schema::create('league_tracker_summoner', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unique();
            $table->string('name');
            $table->string('region');
            $table->boolean('tracking')->default(false);
            $table->timestamps();
        });
	}

	public function down()
	{
        Schema::drop('league_tracker_summoner');
	}

}
