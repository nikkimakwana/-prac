<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;
use App\Models\StripeCard;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $customer = Stripe\Customer::create(array(

            "address" => [

                "line1" => "Virani Chowk",

                "postal_code" => "360001",

                "city" => "Rajkot",

                "state" => "GJ",

                "country" => "IN",

            ],

            "email" => "demo@gmail.com",

            "name" => "Hardik Savani",

            "source" => $request->stripeToken

        ));
        Stripe\Charge::create([

            "amount" => 100 * 100,

            "currency" => "usd",

            "customer" => $customer->id,

            "description" => "Test payment",

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
        $insertArray = array(
            'user_id' => Auth::user()->id,
            'stripe_card_id' => 'card_1LmjZZDwVrOgP9Cxcubsgvfw',
            'stripe_customer_id' =>$customer->id,
            'card_json' =>json_encode($customer),
            'created_at' => date('Y-m-d H:i:s'),
        );
        $insert = StripeCard::create($insertArray);

        Session::flash('success', 'Payment successful!');
        return back();
    }
}
