<?php namespace Stu177\LeagueTracker\Validators;

use Illuminate\Validation\Validator;
use LeagueWrap\Api;
use Stu177\LeagueTracker\Models\Settings;
use Input;

class SummonerValidator extends Validator
{
    /**
     * Retrieves region value from form
     *
     * @return mixed
     */
    private function getRegion()
    {
        return Input::get("Summoner.region");
    }

    /**
     * Checks if summoner is valid
     *
     * @param $attribute
     * @param $value
     * @param $parameters
     * @return bool
     */
    public function validateSummonerExists($attribute, $value, $parameters)
    {
        $api = new Api(Settings::get('api_key'));
        $api->setRegion($this->getRegion());
        $summoner = $api->summoner();

        if(!$check = $summoner->info($value)) {
            return false;
        }

        return true;
    }
}
