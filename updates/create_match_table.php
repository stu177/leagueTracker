<?php namespace Stu177\LeagueTracker\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateMatchTable extends Migration
{

	public function up()
	{
        Schema::create('league_tracker_match', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
	}

	public function down()
	{
        Schema::drop('league_tracker_match');
	}

}
