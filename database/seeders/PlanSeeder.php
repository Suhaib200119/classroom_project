<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::insert(
           [
            [
                "name"=>"Free Plan",
                "price" => 0,
                "featured"=>0

            ],
            [
                "name"=>"Basic Plan",
                "price" => 2000,
                "featured"=>1
            ],
            [
                "name"=>"Pro Plan",
                "price" => 8000,
                "featured"=>0
            ],
           ]
        );

       

        
    }
}
