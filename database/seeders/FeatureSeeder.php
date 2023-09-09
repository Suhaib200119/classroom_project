<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feature::insert(
           [
            [
                "name"=>"Classrooms #",
                "code" => "classrooms-count"
            ],
            [
                "name"=>"Students Per Classroom",
                "code" => "classrooms-students"
            ],
           ]
        );
    }
}
