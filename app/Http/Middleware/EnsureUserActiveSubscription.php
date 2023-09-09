<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user=$request->user();
        $exists=$user->subscriptions()
        ->where("status","=","active")
        ->where("expires_at",">=" , now())
        ->exists();

         // get the number classroom for paln in last subscription
        $lastSubscription=$user->subscriptions()
        ->orderBy("created_at","desc")
        ->first();
        if($lastSubscription){
            $lastSubscription=$lastSubscription->plan
            ->features()
            ->where("code","=","classrooms-count")
            ->first(["feature_value"]);
        }
        
        if(!$exists || $user->classrooms->count()>=$lastSubscription->feature_value){ 
            abort(403,"subscription expire or classrooms larger than ".$lastSubscription->feature_value);
        }

        // check if exists and return
        return $next($request);

    }
}
