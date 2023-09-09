<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SubscriptionsController extends Controller
{
    public function store(Request $request)
    {
        $plan = Plan::findOrFail($request->post("plan_id"));
        $months = $request->post("period"); 
        $subscription = new Subscription();
        $subscription->user_id = Auth::id();
        $subscription->plan_id = $plan->id;
        $subscription->price = ($plan->price/100) * $months;
        $subscription->expires_at = now()->addMonths($months);
            if($plan->price==0){
                $subscription->status="active";
            }else{
                $subscription->status="pending";
            }
        if ($subscription->save()) {
            if($plan->price==0){
                return Redirect::route("index_classroom");
            }
            return Redirect::route("payment_create",$subscription->id);
        }
    }
}
