<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Feedback;
use App\Models\CategoryRecipient;

use Illuminate\Database\Seeder;
use App\Enum\UserRole;
use App\Enum\UserClass;

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
            'email' => 'spadmin@test.com',
            'full_name' => "super admin",
            'role' => UserRole::SuperAdmin->value,
            'password' => 'testlmao'
        ]);

        //admin
        User::create([
            'email' => 'testadmin@test.com',
            'full_name' => "admin test",
            'role' => UserRole::Admin->value,
            'password' => "testlmao"
        ]);



        if (in_array(app()->environment(), ['local', 'dev'])) {
            //student
            $student = User::create([
                'email' => 'teststudent@test.com',
                'full_name' => 'student test',
                'nis' => '489357234856378',
                'role' => UserRole::Student->value,
                'class' => UserClass::XII_RPL_1->value,
                'password' => 'testlmao'
            ]);

            Feedback::factory(7)->create([
                'user_id' => $student->id
            ]);

            Feedback::factory(10)->create();
            CategoryRecipient::factory(10)->create();
        }
    }
}
