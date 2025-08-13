<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory()->create([
            "username" => "testuser",
            "email" => "testuseremail@gmail.com",
            "password" => bcrypt("password"),
        ]);

        User::factory(10)->create();

        // Then create 100 projects, each assigned to a random user
        Project::factory(100)->create();
    }
}
