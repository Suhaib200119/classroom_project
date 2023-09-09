<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("plan_feature")->insert(
           [
            ["plan_id"=>1,"feature_id"=>1,"feature_value"=>1],
            ["plan_id"=>1,"feature_id"=>2,"feature_value"=>10],

            ["plan_id"=>2,"feature_id"=>1,"feature_value"=>10],
            ["plan_id"=>2,"feature_id"=>2,"feature_value"=>20],

            ["plan_id"=>3,"feature_id"=>1,"feature_value"=>30],
            ["plan_id"=>3,"feature_id"=>2,"feature_value"=>40],
           ]

        );
    }
}
