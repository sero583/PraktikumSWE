<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeed extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            // let it auto-increment: "id" => 1,
            "name" => "Admin",
            "email"=>"admin@codeacademy.de",
            "rank" => 1, // >0 -> admin
            "password"=> Hash::make("password") // without hashing login wont work
        ]);
    }
}
