<?php namespace Stu177\LeagueTracker\Models;

use Model;

class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];
    public $settingsCode = 'stu177_leaguetracker_settings';
    public $settingsFields = 'fields.yaml';
    public $table = "league_tracker_settings";

    /*
     * Validation
     */
    public $rules = [
        'api_key' => 'required'
    ];
}
