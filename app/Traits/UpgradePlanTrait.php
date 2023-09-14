<?php

namespace App\Traits;

use App\Models\User;
use App\Models\Membership;

trait UpgradePlanTrait
{

    /**
     * The function is a constructor that takes a User object and a Membership object as parameters and
     * assigns them to class properties.
     * 
     * @param User user The "user" parameter is an instance of the User class. It represents a user
     * object that contains information about a specific user, such as their name, email, and other
     * user-related data.
     * @param Membership membership The membership parameter is an instance of the Membership class. It
     * is being passed into the constructor of the class where this code snippet is located.
     */
    public function __construct(User $user, Membership $membership)
    {
        $this->user = $user;
        $this->membership = $membership;
    }

    /**
     * The function "switchToPremiumPlan" updates the plan type of a user's membership to the specified
     * type.
     * 
     * @param type The type parameter is the new plan type that the user wants to switch to.
     */
    function switchToPremiumPlan($type)
    {
        $this->membership->User()->update(['plan_type' => $type]);
    }

    /**
     * The function "switchToFreePlan" updates the plan type of a user's membership to a specified
     * type.
     * 
     * @param type The type parameter is the new plan type that the user wants to switch to.
     */
    public function switchToFreePlan($type)
    {
        $this->membership->User()->update(['plan_type' => $type]);
    }
}
