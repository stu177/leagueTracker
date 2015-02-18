<?php namespace Stu177\LeagueTracker\Controllers;

use Flash;
use Redirect;
use BackendMenu;
use Backend\Classes\Controller;
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
}
