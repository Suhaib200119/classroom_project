<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class PaymentsController extends Controller
{

    public function create( Subscription $subscription)
    {
        // This is your test secret API key.
        \Stripe\Stripe::setApiKey(config("services.stripe.Secret_key"));
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => ['name' => $subscription->plan->name],
                        'unit_amount' => $subscription->plan->price,
                    ],

                    'quantity' => $subscription->expires_at->diffInMonths($subscription->created_at)
                ],

            ],
            "metadata" => [
                "subscription_id" => $subscription->id,
            ],
            'mode' => 'payment',
            'success_url' => route("payment_success", $subscription->id),
            'cancel_url' =>  route("payment_cancel", $subscription->id),
        ]);
        $payments=new Payments();
        $payments->user_id=Auth::id();
        $payments->subscription_id=$subscription->id;
        $payments->amount=$subscription->plan->price;
        $payments->currency_code="usd";
        $payments->payment_gateway="stripe";
        $payments->status="pending";
        $payments->gateway_reference_id=$checkout_session->id;
        $payments->data=json_encode($checkout_session); 
        if($payments->save()){
            return redirect()->to($checkout_session->url);
        }
    }
    

    public function success(string $subscription_id)
    {
        Subscription::where("id","=",$subscription_id)->update([
            "status"=>"active",
        ]);

        Payments::where("subscription_id","=",$subscription_id)->update([
            "status"=>"completed"
        ]);
       
    }

    public function cancel(string $subscription_id)
    {
        Subscription::where("id","=",$subscription_id)->update([
            "status"=>"pending",
        ]);

        Payments::where("subscription_id","=",$subscription_id)->update([
            "status"=>"failed"
        ]);
    }
}
