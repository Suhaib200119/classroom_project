<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $has_password=Hash::make("suhaib");
        DB::table("users")->insert([
            "name"=>"suhaib",
            "email"=>"sis.22.18a@gmail.com",
            "password"=>$has_password,
        ]);
    }
}
