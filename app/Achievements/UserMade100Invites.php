<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMade100Invites extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "100 Convites";

    /*
     * A small description for the achievement
     */
    public $description = "Completou 100 Convites";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 100;

}
