<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(String $guard): View
    {
        return view('auth.login',["guard"=>$guard]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request,String $guard) //: RedirectResponse
    {
        $request->authenticate($guard);
        $request->session()->regenerate();
        return view("Layouts.parent");
        // if($guard!="admin"){
        //     return redirect()->intended(route("index_classroom"));
        // }else{
        //     return redirect()->route("AdminDash");
        // }

        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request,String $guard): RedirectResponse
    {
        Auth::guard($guard)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        return redirect()->route("login",$guard);
    }
}
