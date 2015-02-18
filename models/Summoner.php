<?php namespace Stu177\LeagueTracker\Models;

use App;
use Str;
use Lang;
use Model;
use Illuminate\Support\Facades\Validator;
use Stu177\LeagueTracker\Validators\SummonerValidator;
use LeagueWrap\Api;

class Summoner extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $table = "league_tracker_summoner";

    /*
     * Validation
     */
    public $rules = [
        'id' => 'unique:league_tracker_summoner',
        'name' => 'required|summonerExists',
        'region' => 'required',
        'tracking' => 'required|boolean'
    ];

    public $customMessages = [
        'summoner_exists' => 'Summoner does not exist in that region.'
    ];

    /**
     * Override parent constructor
     */
    public function __construct()
    {
        // Call the parent method
        parent::__construct();

        Validator::resolver(function($translator, $data, $rules, $messages)
        {
            return new SummonerValidator($translator, $data, $rules, $messages);
        });
    }

    /**
     * Before creating the record, get the unique ID from Riot's API
     */
    public function beforeCreate() {
        $api = new Api(Settings::get('api_key'));
        $api->setRegion($this->region);
        $summoner = $api->summoner();
        $this->id = $summoner->info($this->name)->id;
    }
}
