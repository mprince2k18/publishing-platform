<?php

namespace App\Http\Controllers;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\User;
use Stripe\Customer;
use App\Models\Membership;
use App\Traits\StripeTrait;
use Illuminate\Http\Request;
use App\Traits\UpgradePlanTrait;
use Illuminate\Support\Facades\Session;

class StripePaymentController extends Controller
{

    use StripeTrait, UpgradePlanTrait;

    /**
     * The function is a constructor that takes a User and Membership object as parameters and sets
     * them as properties of the class.
     * 
     * @param User user The "user" parameter is an instance of the User class. It represents a user in
     * the system and is used to perform operations related to the user, such as retrieving user
     * information or updating user data.
     * @param Membership membership The "membership" parameter is an instance of the "Membership"
     * class. It is likely used to handle user memberships or subscriptions in the application.
     */
    public function __construct(User $user, Membership $membership)
    {
        $this->user = $user;
        $this->membership = $membership;
    }
    /**
     * The function makes a payment using Stripe and returns to the previous page with a success
     * message.
     * 
     * @param Request request The  parameter is an instance of the Request class, which is used
     * to retrieve data from the HTTP request. It contains information such as the request method,
     * headers, and input data. In this case, it is used to pass data required for creating a Stripe
     * charge.
     * 
     * @return the user back to the previous page.
     */
    public function make_payment(Request $request)
    {

        $charge = $this->createStripeCharge($request);
        
        // Check the status of the charge
        if ($charge->status === 'succeeded') {
            // change the status of the user's membership to premium
            $this->switchToPremiumPlan($request->type);

            session()->flash('message', 'Successfully paid! Your membership has been upgraded.'); 
            session()->flash('alert-class', 'alert-success');
            return redirect()->route('memberships.index');
        } else {
            session()->flash('message', 'Payment failed! Please try again.'); 
            session()->flash('alert-class', 'alert-danger');
            return redirect()->route('memberships.index');
        }

    }
    //ENDS
}
