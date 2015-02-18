<?php namespace Stu177\LeagueTracker\Controllers;

use Flash;
use Redirect;
use BackendMenu;
use Backend\Classes\Controller;
use Stu177\LeagueTracker\Models\Summoner;
use Stu177\LeagueTracker\Models\Settings;
use LeagueWrap\Api;

/**
 * Summoner Controller
 */
class Summoners extends Controller
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

        BackendMenu::setContext('Stu177.LeagueTracker', 'leagueTracker', 'summoners');

        $this->addCss('/plugins/stu177/leagueTracker/assets/css/stu177.leagueTracker.style.css');
    }

    public function index()
    {
        $this->asExtension('ListController')->index();
    }


    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $summonerId) {
                if ((!$summoner = Summoner::find($summonerId)))
                    continue;

                $summoner->delete();
            }

            Flash::success('Successfully deleted summoner(s).');
        }

        return $this->listRefresh();
    }
}
