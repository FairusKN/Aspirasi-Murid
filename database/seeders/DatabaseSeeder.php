<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Feedback;
use App\Models\Category;

use Illuminate\Database\Seeder;
use App\Enum\UserRole;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        //superadmin
        User::create([
            'username' => 'spadmin',
            'full_name' => "super admin",
            'role' => UserRole::SuperAdmin->value,
            'password' => 'testlmao'
        ]);

        //admin
        User::create([
            'username' => 'testadmin',
            'full_name' => "admin test",
            'role' => UserRole::Admin->value,
            'password' => "testlmao"
        ]);

        //student
        $student =  User::create([
            'username' => 'teststudent',
            'full_name' => 'student test',
            'role' => UserRole::Student->value,
            'password' => 'testlmao'
        ]);

        //Feedback
        $category = Category::create([
            "name" => "test",
            "details" => "testlmao"
        ]);

        Feedback::create([
            'user_id' => $student->id,
            'category_id' => $category->id,
            "feeedback_title" => "test tittle",
            "details" => "test details",
            "location" => "test location",
        ]);
    }
}
