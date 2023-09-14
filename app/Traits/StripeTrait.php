<?php

namespace App\Traits;

use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

trait StripeTrait
{
    public function createStripeCharge($request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $customer = Customer::create([
            "address" => [
                "line1" => "60 Feet, Mirpur 2, Dhaka",
                "postal_code" => "360001",
                "city" => "Dhaka",
                "state" => "Dhaka",
                "country" => "BD",
            ],
            "email" => auth()->user()->email,
            "name" => auth()->user()->name,
            "source" => $request->stripeToken
        ]);

        $charge = Charge::create([
            "amount" => $request->amount * 100,
            "currency" => "usd",
            "customer" => $customer->id,
            "description" => "Example charge",
            "shipping" => [
                "name" => "Jenny Rosen",
                "address" => [
                    "line1" => "510 Townsend St",
                    "postal_code" => "98140",
                    "city" => "San Francisco",
                    "state" => "CA",
                    "country" => "US",
                ],
            ]
        ]);

        return $charge; // Return the Stripe charge object
    }
}
