<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Traits\UpgradePlanTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MembershipController extends Controller
{

    use UpgradePlanTrait;

    public function __construct(Membership $membership, User $user)
    {
        $this->membership = $membership;
        $this->user = $user;
    }

    public function index()
    {
        return view('memberships.index');
    }

    public function membership_type($type)
    {

        if ($type === 'free') {
            $this->switchToFreePlan($type);

            session()->flash('message', 'Successfully downgraded! Your membership has been downgraded.'); 
            session()->flash('alert-class', 'alert-success');
            return redirect()->route('memberships.index');
        }

        return view('memberships.registration', compact('type'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'type' => ['required'],
            'amount' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Create a membership for the user
        $membership = Membership::create([
            'user_id' => $user->id,
            'type' => $request['type'],
        ]);

        return redirect()->route('stripe.index');

    }
    //ENDS
}
