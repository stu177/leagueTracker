<?php namespace Stu177\LeagueTracker\Models;

use App;
use Str;
use Lang;
use Model;
use LeagueWrap\Api;

class Match extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = "league_tracker_match";

    /*
     * Validation
     */
    public $rules = [
        'id' => 'required'
    ];
}
