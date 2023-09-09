<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index(){

        
        return view("welcome",[
            "plans"=>Plan::all()
        ]);
    }
}
