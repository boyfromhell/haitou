<?php

namespace App\Achievements;

use Gstt\Achievements\Achievement;

class UserMadeFirstBirthday extends Achievement
{
    /*
     * The achievement name
     */
    public $name = "Primeiro Aniversario";

    /*
     * A small description for the achievement
     */
    public $description = "Membro há pelo menos 1 ano.";

    /*
     * The amount of points required to unlock this achievement.
     */
    public $points = 1000;

    /*
     * Triggers whenever an Achiever unlocks this achievement
    */
    public function whenUnlocked($progress)
    {
        return auth()->user()->updatePoints($this->points);
    }

}
