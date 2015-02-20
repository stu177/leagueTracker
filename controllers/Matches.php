<?php namespace Stu177\LeagueTracker\Controllers;

use Flash;
use Redirect;
use BackendMenu;
use Backend\Classes\Controller;
use LeagueWrap\Api;
use Stu177\LeagueTracker\Models\Settings;
use Stu177\LeagueTracker\Models\Summoner;
use Stu177\LeagueTracker\Models\Match;

/**
 * Summoner Controller
 */
class Matches extends Controller
{
    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController'
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Stu177.LeagueTracker', 'leagueTracker', 'matches');

        $this->addCss('/plugins/stu177/leagueTracker/assets/css/stu177.leagueTracker.style.css');
    }

    public function index()
    {
        $this->asExtension('ListController')->index();
    }

    public function index_onGetMatches()
    {
        $api = new Api(Settings::get('api_key'));

        $summoners = new Summoner();

        foreach($summoners->where('tracking', true)->get() as $summoner) {
            $api->setRegion($summoner->region);
            $game = $api->game();
            $games = $game->recent($summoner->id);

            foreach($games as $key => $game) {
                $match = new Match();
                $match->id = $game->gameId;
                $match->save();
            }
        }

        Flash::success('Successfully retrieved matches for tracked summoner(s).');

        return $this->listRefresh();
    }

    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $matchId) {
                if ((!$match = Match::find($matchId)))
                    continue;

                $match->delete();
            }

            Flash::success('Successfully deleted match(es).');
        }

        return $this->listRefresh();
    }
}
