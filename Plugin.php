<?php namespace Stu177\LeagueTracker;

use App;
use Backend;
use Controller;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name' => 'League of Legends Tracker Plugin',
            'description' => 'Tracks the games of a summoner.',
            'author' => 'stu177',
            'icon' => 'icon-rocket'
        ];
    }

    public function registerNavigation()
    {
        return [
            'leagueTracker' => [
                'label' => 'League Tracker',
                'url' => Backend::url('stu177/leagueTracker/summoners'),
                'icon' => 'icon-rocket',
                'permissions' => ['user.*'],
                'order' => 500,
                'sideMenu' => [
                    'summoners' => [
                        'label'       => 'Summoners',
                        'icon'        => 'icon-user',
                        'url'         => Backend::url('stu177/leagueTracker/summoners'),
                        'permissions' => [''],
                    ],
                    'matches' => [
                        'label'       => 'Matches',
                        'icon'        => 'icon-history',
                        'url'         => Backend::url('stu177/leagueTracker/matches'),
                        'permissions' => [''],
                    ]
                ]
            ]
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'League Tracker',
                'description' => 'Options for League Tracker and configuration.',
                'icon' => 'icon-rocket',
                'class'       => 'stu177\leagueTracker\Models\Settings'
            ]
        ];
    }
}
