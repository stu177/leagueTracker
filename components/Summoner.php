<?php namespace Stu177\LeagueTracker\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Stu177\LeagueTracker\Models\Summoner;

class Summoner extends ComponentBase
{
    /**
     * @var Stu177\LeagueTracker\Models\Summoner The post model used for display.
     */
    public $summoner;

    public function componentDetails()
    {
        return [
            'name' => 'Summoner',
            'description' => 'Stores information about a summoner.'
        ];
    }
}
